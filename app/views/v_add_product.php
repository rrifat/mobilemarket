<?php include("../app/views/includes/admin_header.php") ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Products Panel</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add product
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Enter Product Name</label>
                                            <input class="form-control" placeholder="Product Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Select Product Category</label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Select Product Label</label>
                                            <select class="form-control">
                                                <option>No Label</option>
                                                <option>On Sale</option>
                                                <option>New</option>
                                                <option>Featured Products</option>
                                                <option>Holiday Deals</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Product Description</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Product Image</label>
                                            <input type="file">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Product Price</label>
                                            <input class="form-control" placeholder="Product Price">
                                        </div>
                                        <div class="form-group">
                                            <label>Enter Product Stock Quantity</label>
                                            <input class="form-control" placeholder="Stock Quantity">
                                        </div>

                                        <button type="submit" class="btn btn-default">Add Product</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

