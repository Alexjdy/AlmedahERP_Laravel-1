<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadManufacturingWorkstation();'
            class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">Workstation Form</h2>
    </h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Dropdown link</a>
                        <a class="dropdown-item" href="#">Dropdown link</a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1" id="saveBtn">Save</button>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid" style="margin: 0; padding: 0;">
    <div class="row mt-2 mb-3">
        <div class="col">
            <div class="card">
                <!-- <div class="card-header">
                    <div class="float-right">
                        <button class="btn btn-secondary btn-sm" onclick="loadReportsBuilderShowReport();">Show Report</button>
                        <button class="btn btn-secondary btn-sm">Disable Report</button>
                    </div>
                </div> -->
                <div class="card-body">
                    <h6><strong>DESCRIPTION</strong></h6>

                    <form method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Workstation Name</label>
                                <input type="text" class="form-control" id="station_name" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Description</label>
                                <textarea class="form-control" rows="10" id="station_desc"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                
                
                <div class="card-footer">
                    <!-- <div class="btn-group" role="group">
                        <button type="button" class="btn btn-dark" href="#">20</button>
                        <button type="button" class="btn btn-secondary" href="#">100</button>
                        <button type="button" class="btn btn-secondary" href="#">500</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#saveBtn").on('click', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = new FormData();
        formData.append('station_name', $("#station_name").val());
        formData.append('description', $("#station_desc").val());
        $.ajax({
            type: "POST",
            url: "/create-station",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                loadManufacturingWorkstation();
            }
        });
    });
</script>