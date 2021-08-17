/**
 * $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        }
    });
 */

var BOM_SUCCESS_CLASS = "#bom_success_message";
var BOM_FAIL_CLASS = "#bom_alert_message";

$(document).ready(function () {
    amountChanger();
});

function amountChanger() {
    $("input[name='Rate']").each(function () {
        $(this).change(function () {
            let master = $(this).parent("td").parent();
            let qty = parseInt(master.find("#Quantity").val());
            let newAmount = parseFloat($(this).val()) * qty;
            master.find("#Amount").val(newAmount);
        });
    });
}

$("#routingSelect").change(function () {
    if ($(this).val() === "newRouting") {
        showRoutingsForm();
        $(this).val(0);
    } else {
        var routing_code = $(this).val();
        $("#bom-operations tbody tr").remove();
        var table = $("#bom-operations tbody");
        $.ajax({
            type: "GET",
            url: `/get-routing-ops/${routing_code}`,
            data: routing_code,
            success: function (response) {
                let operations = response.operations;
                for (let i = 0; i < operations.length; i++) {
                    let description = operations[i].operation.description;
                    let desc_clean = description.replace(/(<([^>]+)>)/gi, "");
                    table.append(
                        `
                        <tr id="bomOperation-${i}">
                                <td class="text-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                                <td id="mr-code-input" class="mr-code-input"><input type="text" value="${operations[i].operation.operation_name}" readonly
                                        name="Operation_name" id="Operation_name" class="form-control"></td>
                                <td style="width: 10%;" class="mr-qty-input"><input type="text" value="${operations[i].operation.wc_code}" readonly
                                        name="D_workcenter" id="D_workcenter" class="form-control"></td>
                                <td class="mr-unit-input"><input type="text" value="${desc_clean}" readonly name="Desc" id="Desc"
                                        class="form-control"></td>
                                <td class="mr-unit-input"><input type="text" value="${operations[i].operation_time}" readonly name="Operation_Time"
                                        id="Operation_Time" class="form-control"></td>
                                <td class="mr-unit-input"><input type="text" value="${operations[i].operating_cost}" readonly name="Operation_cost"
                                        id="Operation_cost" class="form-control"></td>

                                <td>
                                    <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#"
                                        role="button">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a id="" class="btn delete-btn" href="#" role="button">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        `
                    );
                }
                computeCosts();
            },
        });
    }
});

function computeCosts() {
    var materialCost = 0;
    var opCost = 0;
    var operations = $("#bom-operations tbody tr");
    for (let i = 0; i < operations.length; i++) {
        let operation = $(`#bomOperation-${i}`);
        let op_indiv_cost = operation.find("#Operation_cost").val()
            ? operation.find("#Operation_cost").val()
            : 0;
        opCost += parseFloat(op_indiv_cost);
    }
    var materials = $("#bom-materials tbody tr");
    for (let i = 0; i < materials.length; i++) {
        let material = $(`#bomMaterial-${i}`);
        let mat_indiv_cost = material.find("#Amount").val()
            ? material.find("#Amount").val()
            : 0;
        materialCost += parseFloat(mat_indiv_cost);
    }
    var totalCost = parseFloat(opCost) + parseFloat(materialCost);
    $("#totalOpCost").val(parseFloat(opCost));
    $("#totalMatCost").val(parseFloat(materialCost));
    $("#totalBOMCost").val(parseFloat(totalCost));
}

/**Experimental function from back-end*/
function showRoutingsForm() {
    let menu = "NewRouting";
    loadTab(menu, "New Routing");
}

$("#is_component").change(function () {
    var other;
    if ($(this).prop("checked") == true) {
        $("#component-select").prop("hidden", false);
        $("#product-select").prop("hidden", true);
        other = "#manprod";
    } else {
        $("#component-select").prop("hidden", true);
        $("#product-select").prop("hidden", false);
        other = "#components";
    }
    $(other).val(0);
    $("#bom-materials tbody tr").remove();
    $(other).selectpicker("refresh");
    $("#item_content").css("display", "none");
    $(`#Item_name`).val(null);
    $(`#Item_UOM`).val(null);
});

$("#manprod, #components").change(function () {
    let showForm = $(this).val();
    if (showForm == 0) {
        $("#item_content").css("display", "none");
        $(`#Item_name`).val(null);
        $(`#Item_UOM`).val(null);
    } else {
        $("#item_content").css("display", "block");
        if ($(this).attr("id") === "components")
            $("#selected-uom").css("display", "none");
        else $("#selected-uom").show();
    }
});

$(`.bom-item-select`).change(function () {
    if ($(this).val() == 0) return;
    let item_code = $(this).val().trim();
    var id = $(this).attr('id');
    var item_type = (id === 'manprod') ?  'product' : 'component';
    console.log(item_type);
    $.ajax({
        type: "GET",
        url: `/get-item/${item_type}/${item_code}`,
        data: item_code,
        success: function (response) {
            console.log(response);
            let item = response.item;
            if(item.product_code) {
                $(`#Item_name`).val(item.product_name);
                $(`#Item_UOM`).val(item.unit);
            } else {
                $("#Item_name").val(item.component_name);
            }
            var table = $("#bom-materials tbody");
            $("#bom-materials tbody tr").remove();
            let materials = response.materials_info;
            for (let i = 0; i < materials.length; i++) {
                let subtotal =
                    parseFloat(materials[i].rate) *
                    parseFloat(materials[i].qty);
                let is_readonly =
                    materials[i].rate == 1 ? "" : "readonly";
                table.append(
                    `
                    <tr id="bomMaterial-${i}">
                        <td class="text-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td id="mr-code-input" class="mr-code-input"><input type="text" value="${
                            i + 1
                        }" readonly
                                name="No" id="No" class="form-control"></td>
                        <td style="width: 10%;" class="mr-qty-input"><input type="text" value="${
                            materials[i].item.item_code
                        }" readonly
                                name="ItemCode" id="ItemCode" class="form-control"></td>
                        <td class="mr-unit-input"><input type="text" value="${
                            materials[i].qty
                        }" readonly name="Quantity"
                                id="Quantity" class="form-control"></td>
                        <td class="mr-unit-input"><input type="text" value="${
                            materials[i].uom.item_uom
                        }" readonly name="UOM" id="UOM"
                                class="form-control"></td>
                        <td class="mr-unit-input"><input type="text" value="${
                            materials[i].rate
                        }" ${is_readonly} name="Rate" id="Rate"
                                class="form-control"></td>
                        <td class="mr-unit-input"><input type="number" value="${subtotal}" readonly name="Amount" id="Amount"
                                class="form-control"></td>
                        <td>
                            <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#"
                                role="button">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <a id="" class="btn delete-btn" href="#" role="button">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    `
                );
            }
            computeCosts();
            amountChanger();
        },
        error: function (response) {
            console.log(response);
        },
    });
});

function addRowoperations() {
    if ($("#no-data")[0]) {
        deleteItemRow($("#no-data").parents("tr"));
    }
    let lastRow = $("#operations-input-rows tr:last");
    let nextID = lastRow.length != 0 ? lastRow.data("id") + 1 : 0;
    $("#operations-input-rows").append(
        `<tr data-id="${nextID}">
        <td class="text-center">

        <div class="form-check" >
            <input type="checkbox" class="form-check-input">
        </div>
        </td>
        <td id="mr-code-input" class="mr-code-input"><input type="text" value="" readonly name="Operation_name" id="Operation_name" class="form-control"></td>
        <td style="width: 10%;" class="mr-qty-input"><input type="text" value="" readonly name="D_workcenter" id="D_workcenter" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Desc" id="Desc" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Operation_Time" id="Operation_Time" class="form-control"></td>
        <td class="mr-unit-input"><input type="text" value="" readonly name="Operation_cost" id="Operation_cost" class="form-control"></td>

        <td>
            <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#" role="button">
                <i class="fa fa-edit" aria-hidden="true"></i>
            </a>
            <a id="" class="btn delete-btn" href="#" role="button">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </td>
    </tr>`
    );
    $('#selects select[data-id="item_code"]')
        .clone()
        .appendTo(`#items-tbl tr:last .mr-code-input`)
        .selectpicker();
    $('#selects select[data-id="station_id"]')
        .clone()
        .appendTo(`#items-tbl tr:last .mr-target-input`)
        .selectpicker();
    $('#selects select[data-id="uom_id"]')
        .clone()
        .appendTo(`#items-tbl tr:last .mr-unit-input`)
        .selectpicker();
    $('#items-tbl tr:last select[name="procurement_method[]"]').selectpicker();
}

function addRowmaterials() {
    if ($("#no-data")[0]) {
        deleteItemRow($("#no-data").parents("tr"));
    }
    let lastRow = $("#materials-input-rows tr:last");
    let nextID = lastRow.length != 0 ? lastRow.data("id") + 1 : 0;
    $("#materials-input-rows").append(
        `                <tr data-id="${nextID}">
    <td class="text-center">

    <div class="form-check" >
        <input type="checkbox" class="form-check-input">
    </div>
    </td>
    <td id="mr-code-input" class="mr-code-input"><input type="text" value="" readonly name="No" id="No" class="form-control"></td>
    <td style="width: 10%;" class="mr-qty-input"><input type="text" value="" readonly name="ItemCode" id="ItemCode" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="Quantity" id="Quantity" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="UOM" id="UOM" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="Rate" id="Rate" class="form-control"></td>
    <td class="mr-unit-input"><input type="text" value="" readonly name="Amount" id="Amount" class="form-control"></td>
    <td>
        <a id="" class="btn" data-toggle="modal" data-target="#editLinkModal" href="#" role="button">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
        <a id="" class="btn delete-btn" href="#" role="button">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
    </td>
</tr>`
    );
    $('#selects select[data-id="item_code"]')
        .clone()
        .appendTo(`#items-tbl tr:last .mr-code-input`)
        .selectpicker();
    $('#selects select[data-id="station_id"]')
        .clone()
        .appendTo(`#items-tbl tr:last .mr-target-input`)
        .selectpicker();
    $('#selects select[data-id="uom_id"]')
        .clone()
        .appendTo(`#items-tbl tr:last .mr-unit-input`)
        .selectpicker();
    $('#items-tbl tr:last select[name="procurement_method[]"]').selectpicker();
}

$("#saveBom").click(function () {
    $("#saveBomForm").submit();
});

$("#saveBomForm").submit(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
        },
    });

    if ($("#manprod").val() == 0 && $("#components").val() == 0) {
        slideAlert("No product/component to make a BOM on.", BOM_FAIL_CLASS);
        return false;
    }
    if ($("#routingSelect").val() == 0) {
        slideAlert("No routing has been provided.", BOM_FAIL_CLASS);
        window.scrollTo(0, 0);
        return false;
    }

    let bomData = new FormData(this);
    let isActive = $("#Is_active").prop("checked") ? 1 : 0;
    let isDefault = $("#default").prop("checked") ? 1 : 0;
    let productsAndRates = {};

    for (let i = 0; i < $("#bom-materials tbody tr").length; i++) {
        let material = $(`#bomMaterial-${i}`);
        productsAndRates[i] = {
            item_code: material.find("#ItemCode").val(),
            qty: parseInt(material.find("#Quantity").val()),
            rate: parseFloat(material.find("#Rate").val()),
        };
    }

    let name = $("#is_component").prop("checked")
        ? "component_code"
        : "product_code";
    let value = $("#is_component").prop("checked")
        ? $("#components").val()
        : $("#manprod").val();

    bomData.append(name, value);
    bomData.append("routing_id", $("#routingSelect").val());
    bomData.append("is_active", isActive);
    bomData.append("is_default", isDefault);
    bomData.append("rm_cost", parseFloat($("#totalMatCost").val()));
    bomData.append("total_cost", parseFloat($("#totalBOMCost").val()));
    bomData.append("rm_rates", JSON.stringify(productsAndRates));

    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: bomData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.message) {
                slideAlert(response.message, BOM_SUCCESS_CLASS);
            }
            loadBOMtable();
        },
    });
    return false;
});

$("#bomDelete").click(function () {
    $("#deleteBOM").submit();
});

$("#deleteBOM").submit(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
        },
    });
    $.ajax({
        type: "DELETE",
        url: $(this).attr("action"),
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            loadBOMtable();
        },
    });
    return false;
});
