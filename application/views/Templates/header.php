<style>
    #tblData {
        font-family: "Comic Sans MS";
    }
    #tblData_info {
        font-family: "Comic Sans MS";
        font-size: 14px;
        text-align: left;
    }
    #tblData_filter {
        font-family: "Comic Sans MS";
        font-size: 14px;
    } 
    .table > tbody > tr > td {
        vertical-align: middle;
        text-align: center;
        font-size: 14px;
    }
    .table > thead > tr > th {
        text-align: center;
        font-size: 17px;
        font-family: "Comic Sans MS";
    }
    .table > tbody > tr {
        font-size: 15px;
    }
    .table > thead > tr {
        font-size: 20px;
    }
    label {
        vertical-align: middle;
    }
    select.form-control + .chosen-container .chosen-search input[type=text] {
        color: black;
    }
    select.form-control + .chosen-container.chosen-container-single .chosen-single {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.428571429;
        color: #555;
        vertical-align: middle;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
        -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        background-image:none;
    }
    label.btn{
        margin-top: 0px;
    }
    div.dt-buttons {
      position: relative;
      float: left;
    }
    </style>
<!--HEADER-->
<h1><p class="pull-right"><?php echo @$head ?> </p></h1>
<div class="clearfix"> </div>