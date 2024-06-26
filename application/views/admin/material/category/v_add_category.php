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
                    <h1><b><?= $title_page; ?></b></h1>
                </div>
                
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $title_card ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?= form_open('admin/save_category', array('id' => 'form-add-category')); ?>
            <div class="card-body">
                <div class="form-group">
                    <input type="text" name="code_category" class="form-control" id="code_category" placeholder="Enter Code Category" value="<?= set_value('code_category') ?>">
                </div>
                <div class="form-group">
                    <input type="text" name="name_category" class="form-control" id="name_category" placeholder="Enter Name Category">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
            <a type="button" class="btn btn-danger" href="<?=base_url('admin/category')?>"" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- jquery-validation -->
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/template/') ?>plugins/jquery-validation/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
        $('#code_category').focus();

        $('#reset_btn').click(function() {
            $('#code_category').focus();
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
                            }, 2000); // Penundaan selama 2000 milidetik (2 detik)
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
        $('#form-add-category').validate({
            rules: {
                code_category: {
                    required: true,
                    remote: {
                        url: "<?= site_url('admin/check_code_category') ?>",
                        type: "POST",
                        data: {
                            'code_category': function() {
                                return $("#code_category").val();
                            }
                        }
                    }
                },
                name_category: {
                    required: true,
                },
            },
            messages: {
                code_category: {
                    required: "Please enter a code category",
                    remote: "Code category already exist"
                },
                name_category: {
                    required: "Please enter a name category",
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
    });
</script>