
function ajaxCallBAck(url, method, data, result){
    $.ajax({
        url:url,
        method:method,
        dataType:"json",
        data:data,
        success:result,
        error:function(xhr){
            //console.log(xhr.responseText);
        }
    });
}
//categories funx
if(document.URL.includes("categoryTable.php")){
    //delete category
    $(document).on("click", ".deleteCategory", function(e){
        e.preventDefault();
        var dataCat=$(this).attr("data-id");
        var dataToSendC={
            dataCat:dataCat
        }
        console.log(dataToSendC);

        ajaxCallBAck("modals/deleteCategory.php", "post", dataToSendC, function(result){
            writeCategory(result);
        });
    })
    function writeCategory(arrayCat){
        var html11="";
        html11+=`<table class="table"> 
        <thead>
          <tr>
            <th scope="col">id_cat</th>
            <th scope="col">name_cat</th>
          </tr>
        </thead>
        <tbody>`;
        for(var obj11 of arrayCat){
            html11+=` <tr>
            <th scope="row">${obj11.id_cat}</th>
            <td><input type="text" id="nameCategory${obj11.id_cat}" class="form-control" value="${obj11.name_cat}"></td>
            <td><a href="#" data-id="${obj11.id_cat}" class="updateCategory">Update</a></td>
            <td><a href="#" data-id="${obj11.id_cat}" class="deleteCategory">Delete</a></td>
          </tr>`
        }
        html11+=` </tbody>
        </table`;
        $("#category").html(html11);
    }
    //update category
    $(document).on("click", ".updateCategory", function(e){
        e.preventDefault();
        var dataCategory=$(this).attr("data-id");
        var nameCategory=$("#nameCategory"+dataCategory).val();

        var dataToSendC={
            dataCategory:dataCategory,
            nameCategory:nameCategory,
        }

        ajaxCallBAck("modals/updateCategory.php", "post", dataToSendC, function(result){
            writeCategory(result);
          });
    })
    //insert category
    $("#insertCategory").click(function(e){
       e.preventDefault();
       var nameCategory=$("#nameCategory").val();
       var valid=true;

       if(nameCategory==""){
           valid=false;
        }
       else{
           valid=true;
        }

        if(valid){
            var dataToSendC={
                nameCategory:nameCategory,
            }
        }
       
    ajaxCallBAck("modals/insertCategory.php", "post", dataToSendC, function(result){
        alert(result);
        location.reload();
    });

    });
}
