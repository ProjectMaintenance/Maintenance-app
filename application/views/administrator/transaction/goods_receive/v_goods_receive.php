<style type="text/css">
    input[type="text"] {
        text-transform: uppercase;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title_page; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('administrator/dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><?= $bread_crumb; ?></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <a href="<?= site_url('administrator/add_goods_receive') ?>" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add Data</a>
                </h2>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="tbl_transaction" class="table table-bordered table-striped nowrap">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>GR CODE</th>
                            <th>DATE</th>
                            <th>MATERIAL CODE</th>
                            <th>GR QUANTITY</th>
                            <th>IDENTITY PIC</th>
                            <th>DESCRIPTION</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($goods_receive as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->id_transaction ?></td>
                                <td><?= $value->date ?></td>
                                <td><?= $value->code_material ?></td>
                                <td><?= $value->quantity ?></td>
                                <td><?= $value->identity_pic ?></td>
                                <td><?= $value->description ?></td>
                                <td class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#update_gr<?= $value->id_transaction; ?>">
                                        <i class="fas fa-edit mr-2"></i>Update
                                    </button>
                                    <button type="button" class="btn btn-danger" id="delete_transaction" data-id-transaction="<?= $value->id_transaction; ?>"><i class="fas fa-trash mr-2"></i>Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php foreach ($goods_receive as $value) : ?>
    <div class="modal fade" id="update_gr<?= $value->id_transaction; ?>" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Update <?= $value->id_transaction; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('administrator/update_goods_receive', array('id' => 'form-update-gr' . $value->id_transaction)); ?>
                <div class="card-body">
                    <input type="hidden" class="form-control" id="id_transaction" name="id_transaction" placeholder="Enter ID Transaction" value="<?= $value->id_transaction; ?>" readonly>
                    <div class="form-group">
                        <label for="gr_code">GR CODE</label>
                        <input type="text" class="form-control" id="gr_code<?= $value->id_transaction; ?>" name="gr_code" placeholder="Enter ID Transaction" value="<?= $value->id_transaction; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="date_transaction">DATE TRANSACTION</label>
                        <!-- Menampilkan input tanggal dengan tanggal dari data transaksi -->
                        <input type="date" name="date_transaction" class="form-control" id="date_transaction<?= $value->id_transaction; ?>" value="<?= isset($value->date) ? date('Y-m-d', strtotime($value->date)) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="material">Material Code</label>
                        <select class="form-control select2" id="material<?= $value->id_transaction; ?>" name="material" style="width: 100%;">
                            <option selected="selected" value="">- Select Material -</option>
                        </select>
                        <input type="hidden" class="form-control" id="code_material<?= $value->id_transaction; ?>" name="code_material" placeholder="Enter Material Code" value="<?= $value->code_material; ?>" readonly>
                        <input type="text" class="form-control" id="name_material<?= $value->id_transaction; ?>" name="name_material" placeholder="Enter Material" value="<?= $value->code_material . ' - ' . $value->additional_description . ' - ' . $value->code_location ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="quantity">QUANTITY</label>
                        <input type="number" class="form-control" id="quantity<?= $value->id_transaction; ?>" name="quantity" placeholder="Enter ID Transaction" value="<?= $value->quantity; ?>">
                    </div>
                    <div class="form-group">
                        <label for="identity_pic">IDENTITY PIC</label>
                        <input type="text" class="form-control" id="identity_pic<?= $value->id_transaction; ?>" name="identity_pic" placeholder="Enter ID Transaction" value="<?= $value->identity_pic; ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">DESCRIPTION</label>
                        <input type="text" class="form-control" id="description<?= $value->id_transaction; ?>" name="description" placeholder="Enter ID Transaction" value="<?= $value->description; ?>">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Change</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- jquery-validation -->
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        $("#tbl_transaction").DataTable({
            "scrollX": true,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            select: {
                selected: true,
                style: 'multi'
            },
            "buttons": [{
                    extend: "excel",
                    text: '<i class="fas fa-file-excel mr-2"></i> EXCEL',
                    className: 'btn-success',
                    title: '',
                    exportOptions: {
                        stripHtml: false,
                        columns: [0, 1, 2, 3, 4, 5, 6], // Indeks kolom yang ingin dicetak
                    },
                },
                {
                    extend: "print",
                    text: '<i class="fas fa-print mr-2"></i> PRINT',
                    className: 'btn-info',
                    title: '',
                    autoPrint: false,
                    exportOptions: {
                        stripHtml: false,
                        columns: [0, 1, 2, 3, 4, 5, 6], // Indeks kolom yang ingin dicetak
                    },
                },
                {
                    extend: 'selectAll',
                    text: '<i class="fas fa-tasks mr-2"></i> Select All',
                    className: 'btn'
                },
                {
                    extend: 'selectNone',
                    text: '<i class="fas fa-times mr-2"></i> Cancel',
                    className: 'btn-danger'
                }
            ]
        }).buttons().container().appendTo('#tbl_transaction_wrapper .col-md-6:eq(0)');

        <?php foreach ($goods_receive as $value) : ?>

            $.ajax({
                url: "<?php echo base_url('administrator/material_list'); ?>",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    // Bersihkan pilihan lama jika ada
                    $('#material<?= $value->id_transaction ?>').empty();
                    // Tambahkan opsi default
                    $('#material<?= $value->id_transaction ?>').append(
                        '<option selected="selected" value="">- Select Material -</option>');
                    // Loop melalui data material dan tambahkan ke Select2
                    $.each(response.material, function(key, value) {
                        $('#material<?= $value->id_transaction ?>').append('<option value="' + value
                            .code_material + '">' +
                            value.code_material + ' ' +
                            '&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;' +
                            value.specification_material + ' ' +
                            '&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;' +
                            value.name_location + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            $('#material<?= $value->id_transaction ?>').change(function(e) {
                e.preventDefault();

                var code_material = $(this).find('option:selected').val();
                var name_material = $(this).find('option:selected').text();

                if (code_material === null || code_material.trim() === '') {
                    $('#code_material<?= $value->id_transaction; ?>').val('');
                    $('#name_material<?= $value->id_transaction; ?>').val('');
                } else {

                    $('#code_material<?= $value->id_transaction; ?>').val(code_material);
                    $('#name_material<?= $value->id_transaction; ?>').val(name_material);
                    $('#name_material<?= $value->id_transaction; ?>').valid();
                }

            });

            $.validator.setDefaults({
                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: $(form).attr('method'),
                        data: $(form).serialize(),
                        dataType: 'JSON',
                        success: function(response) {
                            if (response.success == true) {
                                toastr.success(response.message);
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500); // Penundaan selama 2000 milidetik (2 detik)
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Tanggapan dari server jika terjadi kesalahan
                            console.log('AJAX Error:', textStatus);
                        },
                    });
                }
            });
            $('#form-update-gr<?= $value->id_transaction ?>').validate({
                rules: {
                    gr_code: {
                        required: true,
                    },
                    date_transaction: {
                        required: true,
                    },
                    name_material: {
                        required: true,
                    },
                    quantity: {
                        required: true,
                    },
                    identity_pic: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                },
                messages: {
                    gr_code: {
                        required: "Please enter a id transaction",
                    },
                    date_transaction: {
                        required: "Please enter a date",
                    },
                    name_material: {
                        required: "Please enter a material",
                    },
                    quantity: {
                        required: "Please enter a quantity",
                    },
                    identity_pic: {
                        required: "Please enter a identity pic",
                    },
                    description: {
                        required: "Please enter a description",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        <?php endforeach; ?>


        //-------------------------------------------------- Delete --------------------------------------------------\\
        $(document).on('click', 'button[data-id-transaction]', function() {
            var id_transaction = $(this).data('id-transaction');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('administrator/delete_transaction') ?>',
                        data: {
                            id_transaction: id_transaction
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Failed!",
                                    text: response.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                title: "Error!",
                                text: "An error occurred while processing your request.",
                                icon: "error"
                            });
                            console.error('AJAX Error:', textStatus, errorThrown);
                        }
                    });
                }
            });
        });
        //-------------------------------------------------- Delete --------------------------------------------------\\
    });
</script>