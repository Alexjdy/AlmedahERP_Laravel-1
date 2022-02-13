<?php

namespace App\Http\Controllers;

use App\Models\ManufacturingProducts;
use App\Models\ManufacturingMaterials;
use App\Models\WorkOrder;
use App\Models\Component;
use App\Models\BillOfMaterials;
use App\Models\ordered_products;
use App\Models\MaterialPurchased;
use App\Models\MaterialRequest;
use App\Models\MaterialsOrdered;
use \App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Exception;
use \stdClass;

class WorkOrderController extends Controller
{
    //
    function index() {
        if(Auth::user()){
            $role_id = Auth::user()->role_id;
            $user_role = UserRole::where('role_id', $role_id)->first();
            $permissions = json_decode($user_role->permissions, true);
        }else{
            $permissions = null;
        }

        $work_orders = WorkOrder::get();
        $sales_ids = array_unique($work_orders->pluck('sales_id')->toArray());
        $sales_ids = array_values($sales_ids);
        $components = array();
        $items = array();
        $quantity = array(); 
        // $planned_dates = array();
        $items_qty = array();
        for ($p = 0; $p < count($sales_ids); $p++) {
            $work_order = WorkOrder::where('sales_id', $sales_ids[$p])->first();
            $work_order_count = WorkOrder::where('sales_id', $sales_ids[$p])->count();
            // $work_order_no = $work_order->work_order_no;
            // $material_request = MaterialRequest::where('work_order_no', $work_order_no)->first();
            // if($material_request){
            //     $planned_start = $material_request->request_date->toDateString();
            //     $planned_end = $material_request->required_date->toDateString();
            //     array_push($planned_dates, [$planned_start, $planned_end]);
            // }
            for($i = 0; $i < $work_order_count; $i++){
                $items_qty = [];
                if($work_order->mat_ordered_id){
                    $mat_ordered_id = $work_order->mat_ordered_id;
                    $material_ordered = MaterialsOrdered::where('mat_ordered_id', $mat_ordered_id)->first();
                    $items_list_received = $material_ordered->items_list();
                    if($items_list_received){
                        foreach($items_list_received as $item){
                            $obj = new stdClass(); 
                            $obj->item_code = $item['item_code'];
                            $obj->qty_received = $item['qty_received'];
                            array_push($items_qty, $obj);
                        }   
                    }else{
                        $items_qty = [];
                    }
                    array_push($quantity, $items_qty);
                }
                $product_code = key(json_decode($work_order->transferred_qty, true));
                array_push($items, $product_code);
            }
            $ordered_product = ordered_products::where('sales_id', $sales_ids[$p])->get();
            $status = $work_order->work_order_status;
            foreach($ordered_product as $o ){
                $product_code = $o->product_code;
                $product = ManufacturingProducts::where('product_code', $product_code)->first();
                $prod_components = $product->components;
                $components_list = json_decode($prod_components, true);
                foreach($components_list as $i){
                    $component = Component::where('id', $i['component_id'])->first();
                    array_push($components, array('component_code'=>$component->component_code, 'status'=>$status, 'type'=>'item'));
                }
                array_push($components, array('component_code'=>$product->product_code, 'status'=>$status, 'type'=>'item'));
            }
        }
        return view('modules.manufacturing.workorder', ['work_orders' => $work_orders, 'components' => $components, 'items' => $items, 'quantity' => $quantity, 'permissions' => $permissions]);
    }

    function getQtyFromMatOrdered($work_order_no){
        $work_order = WorkOrder::where('work_order_no', $work_order_no)->first();
        $mat_ordered_id = $work_order->mat_ordered_id;
        $material_ordered = MaterialsOrdered::where('mat_ordered_id', $mat_ordered_id)->first();

        $items_qty = [];
        if($work_order->mat_ordered_id){
            $mat_ordered_id = $work_order->mat_ordered_id;
            $material_ordered = MaterialsOrdered::where('mat_ordered_id', $mat_ordered_id)->first();
            $items_list_received = $material_ordered->items_list();
            if($items_list_received){
                foreach($items_list_received as $item){
                    $obj = new stdClass(); 
                    $obj->item_code = $item['item_code'];
                    $obj->qty_received = $item['qty_received'];
                    array_push($items_qty, $obj);
                }   
            }else{
                $items_qty = [];
            }
        }

        return response(json_encode($items_qty, true));
    }

    function getRawMaterials($selected, $sales_id, $product_code){
        $product = ManufacturingProducts::where('product_code', $selected)->first();
        if($product){
            $code = array();
            $rm_quantity_array = array();
            $ordered_product = ordered_products::where('sales_id', $sales_id)
                                                ->where('product_code', '=' ,$product_code)->first();
            $quantity_purchased = $ordered_product->quantity_purchased;

            $raw_materials = $product->materials;
            $raw_material_list = json_decode($raw_materials, true);
            $component_qty = 1;
            // SAVES RAW MATERIALS OF PRODUCT TO $CODE VARIABLE
            foreach($raw_material_list as $i){
                $raw_mat = ManufacturingMaterials::where('id', $i['material_id'])->first();
                $rm_quantity = $raw_mat->rm_quantity;
                array_push($rm_quantity_array, $rm_quantity);
                array_push($code, array("item_code"=>$raw_mat->item_code, "item_qty"=>$i['material_qty']));
            }
            $components = $product->components;
            $component_list = json_decode($components, true);
            // SAVES COMPONENT OF PRODUCT TO $CODE VARIABLE
            foreach($component_list as $c){
                $component = Component::where('id', $c['component_id'])->first();
                array_push($rm_quantity_array, null);
                array_push($code, array("item_code"=>$component->component_code, "item_qty"=>$c['component_qty']));
            }
            return response()->json(['item_code' => json_encode($code), 'quantity_purchased' => $quantity_purchased, 
            'component_qty' => $component_qty, 'rm_quantity' => $rm_quantity_array]);
        }else{
            $rm_quantity_array = array();
            $component = Component::where('component_code', $selected)->first();
            $code = $component->item_code;
            $decoded_items = json_decode($code, true);
            foreach($decoded_items as $d){
                $raw_mat = ManufacturingMaterials::where('item_code', $d['item_code'])->first();
                $rm_quantity = $raw_mat->rm_quantity;
                array_push($rm_quantity_array, $rm_quantity);
            }
            $ordered_product = ordered_products::where('sales_id', '=' ,$sales_id)
                                               ->where('product_code', '=' ,$product_code)->first();
            $product_code = $ordered_product['product_code'];
            $quantity_purchased = $ordered_product['quantity_purchased'];
            $product = ManufacturingProducts::where('product_code', $product_code)->first();
            $components = $product->components;
            $items_list = json_decode($components, true);
            foreach($items_list as $i){
                if($i['component_id'] == $component->id){
                    $component_qty = $i['component_qty'];
                }
            }
            return response()->json(['item_code' => $code, 'quantity_purchased' => $quantity_purchased, 
            'component_qty' => $component_qty, 'rm_quantity' => $rm_quantity_array]);
        }
    }

    // function getRawMaterialsSales($work_order_no){
    //     $work_order = WorkOrder::where('work_order_no', $work_order_no)->first();
    //     return response($work_order_no);
    // }

    function onDateChange($work_order_no, $planned_date, $date){
        $work_order = WorkOrder::where('work_order_no', $work_order_no)->update([
            $planned_date => $date,
        ]);
        $work_order = WorkOrder::where('work_order_no', $work_order_no)->first();
        return response($work_order);
    }

    function updateStatus($work_order_no){
        $work_order = WorkOrder::where('work_order_no', $work_order_no)->update([
            'work_order_status' => 'Completed',
        ]);
        $work_order = WorkOrder::where('work_order_no', $work_order_no)->first();
        return response($work_order);
    }

    function getBomId($code, $text){
        if($text == 'Product'){
            $bom = BillOfMaterials::where('product_code', $code)->first();
            return response($bom->bom_id ?? 'Not Available');
        }else{
            $bom = BillOfMaterials::where('component_code', $code)->first();
            return response($bom->bom_id ?? 'Not Available');
        }
    }

    function checkUpdateStatus($work_order_no, $product_code){
        $completed = array();
        $work_order = WorkOrder::where('work_order_no', $work_order_no)->first();
        $created_at = $work_order->created_at;
        $work_orders = WorkOrder::where('created_at', $created_at)->whereNotNull('component_code')->get();
        
        foreach($work_orders as $work_order){
            if(key(json_decode($work_order->transferred_qty, true)) == $product_code){
                array_push($completed, $work_order->work_order_status);
            }
        }
        if(!(in_array("Pending", $completed))){
            $work_order = WorkOrder::where('work_order_no', $work_order_no)->update([
                'work_order_status' => 'Completed',
            ]);
            $work_order = WorkOrder::where('work_order_no', $work_order_no)->first();
        }
        return response($work_order);
    }

    function startWorkOrder($work_order_no){
        $date_now = date_create()->format('Y-m-d H:i:s');
        $work_order = WorkOrder::where('work_order_no', $work_order_no)->update([
            'real_start_date' => $date_now,
        ]);
        $work_order = WorkOrder::where('work_order_no', $work_order_no)->first();
        return response($work_order);
    }
}
