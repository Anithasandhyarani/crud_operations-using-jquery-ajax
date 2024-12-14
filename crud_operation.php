<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery AJAX CRUD Operations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <form id="frm">

            <h4>CRUD Operations</h4>
            <div id="alert"></div>

            <div class="mb-3">
                <label for="country" class="form-label">Country:</label>
                <input type="text" class="form-control w-25" id="country" placeholder="Add new country" name="country">
            </div>
            <div>
                <input type="button" class="btn btn-primary" id="btn" value="Submit">
            </div>
        </form>

        <h4>Country List</h4>
        <div id="countrylist"></div>


        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Updating Country</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form method="post">

                            <h4>Update Country</h4>
                            <div id="alert"></div>

                            <div class="mb-3">
                                <label for="country_update" class="form-label">Country:</label>
                                <input type="text" class="form-control w-25" id="country_update" placeholder="Update country" name="country_update">
                            </div>
                            <div>
                                <input type="hidden" id="c_id" name="c_id" value="">
                                <input type="button" class="btn btn-primary" id="update" name="update" value="Update">
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            FetchRecord();


            $("#btn").click(function() {
                var country = $("#country").val();
                if (country == "") {
                    $("#alert").html('<span style="color:red">Country is required</span>');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "crud_insert.php",
                        data: {
                            country: country
                        },
                        success: function(data) {
                            if (data == "true") {
                                $("#alert").html('<div class="alert alert-success w-25">Successfully data inserted<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                $("#country").val('');
                                FetchRecord();
                            } else {
                                $("#alert").html('<div class="alert alert-danger w-25">Data was not inserted<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                            }
                        },
                        error: function() {
                            $("#alert").html('<div class="alert alert-danger w-25">Error occurred during insertion<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                        }
                    });
                }
            });


            function FetchRecord() {
                $.ajax({
                    type: "POST",
                    url: "crud_select.php",
                    data: {},
                    success: function(data) {
                        $("#countrylist").html(data);
                    },
                    error: function() {
                        $("#countrylist").html('<div class="alert alert-danger">Error fetching country list</div>');
                    }
                });
            }


            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "crud_getSingleRecord.php",
                    data: {
                        c_id: id
                    },
                    success: function(data) {
                        $("#c_id").val(id);
                        $("#country_update").val(data);
                        $('#myModal').modal('show');
                    }
                });
            });


            $("#update").click(function() {
                var country = $("#country_update").val();
                var id = $("#c_id").val();
                if (country == "") {
                    $("#alert").html('<span style="color:red">Country is required</span>');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "crud_update.php",
                        data: {
                            country: country,
                            c_id: id
                        },
                        success: function(data) {
                            if (data == "true") {
                                $("#alert").html('<div class="alert alert-success w-25">Successfully updated<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                $('#myModal').modal('hide');
                                FetchRecord();
                            } else {
                                $("#alert").html('<div class="alert alert-danger w-25">Data was not updated<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                            }
                        },
                        error: function() {
                            $("#alert").html('<div class="alert alert-danger w-25">Error occurred during update<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                        }
                    });
                }
            });


            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                if (confirm("Are you sure you want to delete this country?")) {
                    $.ajax({
                        type: "POST",
                        url: "crud_delete.php",
                        data: {
                            c_id: id
                        },
                        success: function(data) {
                            if (data == "true") {
                                FetchRecord();
                            } else {
                                alert("Error occurred during deletion");
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>