<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <b style="font-size:20px"><?= $title_card; ?></b>
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
                <!-- <img src="<?= base_url('/assets/image/') ?>logo/Isuzu.svg.png" alt="Logo-Isuzu.png" width="250"> -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $count_material; ?></h3>

                                <b>
                                    <p>Material List</p>
                                </b>
                            </div>
                            <div class="icon">
                                <i class="ion ion-grid"></i>
                            </div>
                            <a href="<?= site_url('administrator/material_list') ?>" class="small-box-footer">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <!-- <sup style="font-size: 20px">%</sup> -->
                                <h3><?= $count_goods_receive; ?></h3>

                                <b>
                                    <p>Goods Receive</p>
                                </b>
                            </div>
                            <div class="icon">
                                <i class="ion ion-arrow-graph-up-right"></i>
                            </div>
                            <a href="<?= site_url('administrator/goods_receive') ?>" class="small-box-footer">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $count_goods_issue; ?></h3>

                                <b>
                                    <p>Goods Isue</p>
                                </b>
                            </div>
                            <div class="icon">
                                <i class="ion ion-arrow-graph-down-right"></i>
                            </div>
                            <a href="<?= site_url('administrator/goods_issue') ?>" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $count_users; ?></h3>

                                <b>
                                    <p>Users</p>
                                </b>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="<?= site_url('administrator/manage_user') ?>" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <b style="font-size: 20px;">Department Maintenance | PT. Mesin Isuzu Indonesia</b>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->