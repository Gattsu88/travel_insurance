<?php
    require "layout/header.php";
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"
        type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/hot-sneaks/jquery-ui.css"
      rel="Stylesheet" type="text/css" />
<script src="assets/js/scripts.js"></script>

<div class="container">
    
    <p>&nbsp;</p>
    <div class="alert alert-danger" id="errors">
        <p><?= (isset($errors) ? $errors : "") ?></p>
    </div>
    <br><br>
    <div class="row">
        <div class="mx-auto col-sm-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">New policy</h4>
                    <p><span class="text-danger">*</span> Required fields.</p>
                </div>
                <div class="card-body">
                    <form id="main" class="needs-validation" novalidate="" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">First name <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Last name <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Birthdate <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="" id="birthdate" name="birthdate" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Passport ID <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="passport_id" name="passport_id" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="email" class="form-control" id="email" name="email" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Date from: <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="date_from" name="date_from" placeholder="" value="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Date to: <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="date_to" name="date_to" placeholder="" value="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-check-label">Policy type: <span class="text-danger">*</span></label>
                            <div class="col-lg-9 form-check">
                                <input type="radio" id="individual" name="policy_type" value="individual" checked> Individual<br>
                                <input type="radio" id="group" name="policy_type" value="group"> Group<br>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-12">
                                <h4 id="additionalTitle">Additional insured</h4>
                                <div id="forms">
                                    
                                </div>
                                <button class="btn btn-secondary btn-md btn-block" id="additionalInsured">Additional insured</button><br>

                                <button class="btn btn-sub btn-lg btn-block" type="submit" name="policy_submit">Create policy</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="POST" id="final_form" action="<?= $_SERVER["PHP_SELF"] ?>">
    <input name="json" id="final_data" type="hidden" />
</form>


<?php
    require "layout/footer.php";
?>