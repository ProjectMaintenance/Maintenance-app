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
                <h3 class="card-title"><?= $title_card; ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?= form_open('users/save_good_receive', ['id' => 'form-add-goods-receive']) ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="code_material">Material Code</label>
                    <select class="form-control select2" id="code_material" name="code_material" style="width: 100%;">
                        <option selected="selected" value="">- Select Material -</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity GR</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="0" min="0">
                </div>
                <div class="form-group">
                    <label for="identity_pic">Identity PIC</label>
                    <input type="text" class="form-control" id="identity_pic" name="identity_pic"
                        placeholder="Enter Identity PIC">
                </div>
                <div class="form-group">
                    <label for="description">Alasan Pengambilan</label>
                    <input type="text" class="form-control" id="description" name="description"
                        placeholder="Enter Lasan Pengambilan">
                </div>
                <div class="form-group">
                    <label for="date_time">Date And Time</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?= date('Y-m-d') ?>" readonly>
                    <input type="hidden" id="datetime" name="datetime">
                </div>
                <div class="form-group">
                    <label for="id_transaction">GR Code</label>
                    <input type="text" class="form-control" value="<?= $id_transaction; ?>" id="id_transaction" name="id_transaction" placeholder="Goods Receive Code" readonly>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
            <a type="button" class="btn btn-danger" href="<?=base_url('users/goods_receive')?>"" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
    $('#code_material').select2({
        theme: 'bootstrap4'
    });

    $('.select2').change(function(e) {
        e.preventDefault();
        $(this).valid();
        var selectedValue = $(this).val();
        var selectedText = $(this).find('Option:selected').text();
        // Tampilkan nilai yang dipilih di konsol
        console.log("Material Code: " + selectedValue);
        console.log("Part Name: " + selectedText);
    });

    // Fungsi untuk mendapatkan waktu saat ini dalam format yang sesuai
    function getCurrentTime() {
        var now = new Date();
        var hours = ('0' + now.getHours()).slice(-2);
        var minutes = ('0' + now.getMinutes()).slice(-2);
        var seconds = ('0' + now.getSeconds()).slice(-2);
        var time = hours + ':' + minutes + ':' + seconds;
        return time;
    }

    // Tambahkan event listener untuk input tanggal
    document.getElementById('date').addEventListener('change', function() {
        // Ambil tanggal yang dipilih oleh pengguna
        var selectedDate = this.value;

        // Jika tanggal dipilih, tambahkan waktu saat ini
        if (selectedDate) {
            var currentTime = getCurrentTime();
            var datetime = selectedDate + ' ' + currentTime;
            // Setel nilai input datetime
            document.getElementById('datetime').value = datetime;
        }
    });

    $.ajax({
        url: "<?php echo base_url('users/material_list'); ?>",
        type: "GET",
        dataType: "json",
        success: function(response) {
            // Bersihkan pilihan lama jika ada
            $('#code_material').empty();
            // Tambahkan opsi default
            $('#code_material').append(
                '<option selected="selected" value="">- Select Material -</option>');
            // Loop melalui data material dan tambahkan ke Select2
            $.each(response.material, function(key, value) {
                $('#code_material').append('<option value="' + value.code_material + '">' +
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
    $('#form-add-goods-receive').validate({
        rules: {
            date: {
                required: true,
            },
            code_material: {
                required: true,
            },
            quantity: {
                required: true,
                min: 1
            },
            identity_pic: {
                required: true,
            },
            description: {
                required: true,
            },
        },
        messages: {
            date: {
                required: "Please select date",
            },
            code_material: {
                required: "Please select a material",
            },
            quantity: {
                required: "Please enter a quantity",
                min: 'Please enter a quantity'
            },
            identity_pic: {
                required: "Please enter a identity PIC",
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
});
</script>