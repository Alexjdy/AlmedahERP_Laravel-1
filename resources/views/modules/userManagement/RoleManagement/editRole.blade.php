<form method="POST" id="roleEditForm">
  @csrf
  @method('PATCH')
    <div class="row">
        <div class="col-5">
            <label class=" text-nowrap align-middle">
                Role Name
            </label>
            <div class="d-flex">
                <input type="text" class="form-input form-control" id="roleEditName" name="roleEditName">
                <input type="text" name="hiddenRoleID" id="hiddenRoleID" hidden>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <table class="table table-sm table-bordered table-striped" id="tblEditPermissions">
                <thead>
                    <tr>
                        <th>Permission</th>
                        <th class="text-center"><input type="checkbox" class="edit_priv_all" name="view"> View</th>
                        <th class="text-center"><input type="checkbox" class="edit_priv_all" name="create"> Create</th>
                        <th class="text-center"><input type="checkbox" class="edit_priv_all" name="edit"> Edit</th>
                        <th class="text-center"><input type="checkbox" class="edit_priv_all" name="delete"> Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="roleEditCustomers">
                        <td><input type="checkbox" class="edit_module_all"> Customers</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewCustomers"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateCustomers"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditCustomers"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteCustomers"></td>
                    </tr>
                    <tr id="roleEditEmployees">
                        <td><input type="checkbox" class="edit_module_all"> Employees</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewEmployees"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateEmployees"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditEmployees"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteEmployees"></td>
                    </tr>
                    <tr id="roleEditSuppliers">
                        <td><input type="checkbox" class="edit_module_all"> Suppliers</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewSuppliers"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateSuppliers"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditSuppliers"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteSuppliers"></td>
                    </tr>
                    <tr id="roleEditSupplier_Group">
                        <td><input type="checkbox" class="edit_module_all"> Supplier Group</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewSGroup"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateSGroup"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditSGroup"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteSGroup"></td>
                    </tr>
                    <tr id="roleEditInventory">
                        <td><input type="checkbox" class="edit_module_all"> Inventory/Raw Materials</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewInventory"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateInventory"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditInventory"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteInventory"></td>
                    </tr>
                    <tr id="roleEditComponents">
                        <td><input type="checkbox" class="edit_module_all"> Components</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewComponents"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateComponents"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditComponents"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteComponents"></td>
                    </tr>
                    <tr id="roleEditProducts">
                        <td><input type="checkbox" class="edit_module_all"> Products (Machines)</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="View"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="Create"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="Edit"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="Delete"></td>
                    </tr>
                    <tr id="roleEditStations">
                        <td><input type="checkbox" class="edit_module_all"> Stations</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewStations"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateStations"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditStations"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteStations"></td>
                    </tr>
                    <tr id="roleEditStock_Moves">
                        <td><input type="checkbox" class="edit_module_all"> Stock Moves</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewSMoves"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateSMoves"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditSMoves"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteSMoves"></td>
                    </tr>
                    <tr id="roleEditStock_Traceability">
                        <td><input type="checkbox" class="edit_module_all"> Stock Traceability</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewSTrace"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateSTrace"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditSTrace"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteSTrace"></td>
                    </tr>
                    <tr id="roleEditMaterial_Request">
                        <td><input type="checkbox" class="edit_module_all"> Material Request</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewMatRequest"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateMatRequest"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditMatRequest"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteMatRequest"></td>
                    </tr>
                    <tr id="roleEditRequest_for_Quotation">
                        <td><input type="checkbox" class="edit_module_all"> Request for Quotation</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewReqQuotation"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateReqQuotation"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditReqQuotation"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteReqQuotation"></td>
                    </tr>
                    <tr id="roleEditSupplier_Quotation">
                        <td><input type="checkbox" class="edit_module_all"> Supplier Quotation</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewSQuotation"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateSQuotation"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditSQuotation"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteSQuotation"></td>
                    </tr>
                    <tr id="roleEditEmail_Suppliers">
                        <td><input type="checkbox" class="edit_module_all"> Email Suppliers</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewEmailSuppliers"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateEmailSuppliers">
                        </td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditEmailSuppliers"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteEmailSuppliers">
                        </td>
                    </tr>
                    <tr id="roleEditPurchase_Order">
                        <td><input type="checkbox" class="edit_module_all"> Purchase Order</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewPurchaseOrder"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreatePurchaseOrder">
                        </td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditPurchaseOrder"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeletePurchaseOrder">
                        </td>
                    </tr>
                    <tr id="roleEditPurchase_Receipt">
                        <td><input type="checkbox" class="edit_module_all"> Purchase Receipt</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewPurchaseReceipt"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreatePurchaseReceipt">
                        </td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditPurchaseReceipt"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeletePurchaseReceipt">
                        </td>
                    </tr>
                    <tr id="roleEditPurchase_Invoice">
                        <td><input type="checkbox" class="edit_module_all"> Purchase Invoice</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewPurchaseInvoice"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreatePurchaseInvoice">
                        </td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditPurchaseInvoice"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeletePurchaseInvoice">
                        </td>
                    </tr>
                    <tr id="roleEditPending_Orders">
                        <td><input type="checkbox" class="edit_module_all"> Pending Orders</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewPendingOrders"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreatePendingOrders">
                        </td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditPendingOrders"></td>
                        <td class="text-center"><input type="checkbox" id="DeletPendingOrderse"></td>
                    </tr>
                    <tr id="roleEditMachine_Manual">
                        <td><input type="checkbox" class="edit_module_all"> Machine Manual</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewMachineManual"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateMachineManual">
                        </td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditMachineManual"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteMachineManual">
                        </td>
                    </tr>
                    <tr id="roleEditWork_Center">
                        <td><input type="checkbox" class="edit_module_all"> Work Center</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewWorkCenter"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateWorkCenter"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditWorkCenter"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteWorkCenter"></td>
                    </tr>
                    <tr id="roleEditOperations">
                        <td><input type="checkbox" class="edit_module_all"> Operations</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewOperations"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateOperations"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditOperations"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteOperations"></td>
                    </tr>
                    <tr id="roleEditRoutings">
                        <td><input type="checkbox" class="edit_module_all"> Routings</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewRoutings"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateRoutings"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditRoutings"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteRoutings"></td>
                    </tr>
                    <tr id="roleEditBOM">
                        <td><input type="checkbox" class="edit_module_all"> Bill of Materials</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewBOM"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateBOM"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditBOM"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteBOM"></td>
                    </tr>
                    <tr id="roleEditJob_Scheduling">
                        <td><input type="checkbox" class="edit_module_all"> Jobs Scheduling</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewJobScheduling"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateJobScheduling">
                        </td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditJobScheduling"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteJobScheduling">
                        </td>
                    </tr>
                    <tr id="roleEditSales">
                        <td><input type="checkbox" class="edit_module_all"> Sales</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewSales"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateSales"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditSales"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteSales"></td>
                    </tr>
                    <tr id="roleEditPayment_Logs">
                        <td><input type="checkbox" class="edit_module_all"> Payment Logs</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewPaymentLogs"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreatePaymentLogs"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditPaymentLogs"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeletePaymentLogs"></td>
                    </tr>
                    <tr id="roleEditWarranty">
                        <td><input type="checkbox" class="edit_module_all"> Warranty</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewWarranty"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateWarranty"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditWarranty"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteWarranty"></td>
                    </tr>
                    <tr id="roleEditSerial_Numbers">
                        <td><input type="checkbox" class="edit_module_all"> Serial Numbers</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewSNumber"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateSNumber"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditSNumber"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteSNumber"></td>
                    </tr>
                    <tr id="roleEditWork_Order">
                        <td><input type="checkbox" class="edit_module_all"> Work Order</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewWorkOrder"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateWorkOrder"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditWorkOrder"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteWorkOrder"></td>
                    </tr>
                    <tr id="roleEditDelivery">
                        <td><input type="checkbox" class="edit_module_all"> Products Delivery</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewProductsDelivery"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateProductsDelivery">
                        </td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditProductsDelivery"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteProductsDelivery">
                        </td>
                    </tr>
                    <tr id="roleEditWarranty">
                        <td><input type="checkbox" class="edit_module_all"> Warranty Claims (Repairs)</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewWarrantyClaims"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateWarrantyClaims">
                        </td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditWarrantyClaims"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteWarrantyClaims">
                        </td>
                    </tr>
                    <tr id="roleEditReports">
                        <td><input type="checkbox" class="edit_module_all"> Reports</td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-view" id="ViewReports"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-create" id="CreateReports"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-edit" id="EditReports"></td>
                        <td class="text-center"><input type="checkbox" name="edit-role-check" class="edit-user-delete" id="DeleteReports"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
</form>
