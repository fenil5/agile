@extends('Layout.master')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Form</h2>
                   
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="hr-line-dashed"></div>
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>All form elements   </h5>
                            
                        </div>
                        
                        <div  class="alert alert-success" id="update_successfully" style="display:none"> Update successfully</div>
                        
                        <div class="ibox-content">
                        <form method="post" id="Studentsform"   enctype="multipart/form-data" action="javascript:void(0)">
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10"><input name="Name" id="Name" type="text" class="form-control"></div>
                                </div>
                                
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Color</label>
                                    <div class="col-sm-10">
                                          @foreach($Color as $key=>$cat)
                                            <label><input type="checkbox" class="color"  name="color[]" value="{{ $cat->Name }}"> {{ $cat->Name }}</label>
                                            @endforeach
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">description</label>
                                    <div class="col-sm-10"><textarea id="description" name="description" rows="4" cols="50"></textarea></div>
                                </div>
                                <div class="form-group  row"><label class="col-sm-2 col-form-label">Image</label>
                                    <input type="file" name="image" id="image">
                                    <input type="hidden" name="base64img" id="base64img">
                                    </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary btn-sm"  type="submit" >Add </button>
                                    </div>
                                </div>
                            </form>   
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="table_none" style="display:none">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Basic Table</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> Name</th>
                                <th>Color</th>
                                <th>description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            
                            
                            </tbody>
                        </table>
                        <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary btn-sm" id="add_product_local" type="button">Add Product</button>
                                    </div>
                    </div>
                </div>
            </div>
            
            </div>
            @include('Layout.footerlink')
            
<script>

document.getElementById("image").addEventListener("change", readFile);

var base64img;
var jsonObj = [];
$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param * 1000000)
}, 'File size must be less than 2 MB');
$("#Studentsform").validate({

rules: {
    
    Name:{
        required: true,
    },
    "color[]":{
        required: true,
    },
    description:{
        required: true,
    },
    image: {
        required: true,
        filesize : 2, 
        }
    
},
messages: {
    Name: {
        required: "Please Enter Name",
    },
    "color[]": {
        required: "Please Enter color",
    },
    description: {
        required: "Please Enter description",
    },
    image: {
        required: "Please Enter image",
    }
},
submitHandler: function(form){
    createJSON();
}
});
function createJSON() {
    $("#table_none").show(); 
    var name = $('#Name').val();
    var description = $('#description').val();
    var image = $("#base64img").val();
    var array_color = [];
    $('input[name="color[]"]:checked').each(function(i){
        array_color[i] = $(this).val();
    });
    var color = array_color.toString();

    item = {}
    item ["name"] = name;
    item ["color"] = color;
    item ["description"] = description;
    item ["image"] = image;

    jsonObj.push(item);

    console.log(jsonObj);
    var html="";
    $.each(jsonObj, function (index, obj) {
            html+="<tr>";
            html+="<td>"+index+"</td>";
            $.each(obj, function (key, value) {
            if(key=="image"){
                    html+='<td><img height="100" width="100" src="'+value+'"></td>';
                }
                else{
                    if(value.length<=50){

                    html+="<td>"+value+"</td>";
                    }
                    else{
                        html+="<td>"+value.substring(0,50)+" "+"..."+"</td>";
                    }
                }
                
            });
            
            html+='<td><button class="btn btn-primary btn-sm" data-id="'+index+'" id="Delete" id="">Delete </button><td>';
            html+="</tr>"
        });
        $("#tbody").html(html);
        $('#Name').val("");
        $('#description').val("");
        $("#image").val("");
        $('.color').prop('checked', false);
}


function readFile() {
    //alert();
    if (this.files && this.files[0]) {
      
      var FR= new FileReader();
      
      FR.addEventListener("load", function(e) {
        $("#base64img").val(e.target.result);
      }); 
      
      FR.readAsDataURL( this.files[0] );
    }
    
  }


    $(document).on("click","#Delete",function() {    
        var d_id=$(this).attr("data-id");
        console.log(d_id);
        jsonObj.splice(d_id, 1);
        $("#tbody").html("");
        var html="";
        $.each(jsonObj, function (index, obj) {
            html+="<tr>";
            html+="<td>"+index+"</td>";
            $.each(obj, function (key, value) {
            if(key=="image"){
                    html+='<td><img     height="100" width="100" src="'+value+'"></td>';
                }
                else{
                    html+="<td>"+value+"</td>";
                }
                
            });
            
            html+='<td><button class="btn btn-primary btn-sm" data-id="'+index+'" id="Delete" id="">Delete </button><td>';
            html+="</tr>"
        });
        $("#tbody").html(html);

    });

    $('#add_product_local').on('click', function () {
        
       $.ajax({
            url: '{{ url("add_product_ajax") }}',
            dataType: 'json',
            headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            type: "POST",
            data: {'json':jsonObj},
            success: function(response) {
               console.log("sfdsf");
                $("#tbody").html(" ");
               $("#update_successfully").show();
               $("#update_successfully").fadeOut(5000);

            }
        });
        
    });
   
</script>
@stop 