// function ucitajProdukte(e) {
//     let t = "";
//     e.forEach((e) => {
//         t += jedanProdukt(e);
//     }),
//         (document.querySelector("#store-items").innerHTML = t);
// }
// function jedanProdukt(e) {
//     return `\n    <div class="col-10 col-sm-6 col-lg-4 mx-auto my-3 store-item ${e.category.name}" data-item="${e.category.id}">\n        <div class="card ">\n            <div class="img-container">\n            <img src="${e.picture.src}" class="card-img-top store-img" alt="${e.picture.alt}">\n            <span class="store-item-icon">\n                <i class="fas add-to-cart fa-shopping-cart"></i>\n            </span>\n            </div>\n            <div class="card-body">\n            <div class="card-text d-flex justify-content-between text-capitalize">\n                <h5 id="store-item-name">${e.name}</h5>\n                <h5 class="store-item-value">${e.price} <strong id="store-item-price" class="font-weight-bold"> RSD </strong></h5>\n\n            </div>\n            </div>\n        </div>\n    </div>\n    `;
// }
$(document).ready(function(){

$('#showAll').click(showAll);

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

function showAll(){

    var dataToSend={
        button:true
    }

    ajaxCallBAck("./modals/getAll.php","get",dataToSend, function(result){
        writeProducts(result);
    })
}

// write products

function writeProducts(arrayProducts){
    var html5="";
         if(arrayProducts.length==0){
             html5+=`<div class="col-12">
             <div class="alert text-center mt-5">Sorry, we will be back in stock soon with new arrivals.</div>
             </div>`
         }
         else {

         for(var obj2 of arrayProducts){
                html5+=`<div class="col-10 col-sm-6 col-lg-4 mx-auto my-3 store-item" data-item="$<?=$r->id?>"> 
                <div class="card ">            
                      <div class="img-container">           
                         <img src="img/${obj2.src}" class="card-img-top store-img" alt="${obj2.alt}">          
                          <span class="store-item-icon"><i class="fas add-to-cart fa-shopping-cart"></i></span>
                      </div>         
                      <div class="card-body">            
                          <div class="card-text d-flex justify-content-between text-capitalize">                
                            <h5 id="store-item-name">${obj2.name}</h5>
                            <h5 class="store-item-value">${obj2.cena}
                                <strong id="store-item-price" class="font-weight-bold"> RSD </strong>
                            </h5>
                          </div>
                      </div>
                  </div>
              </div> `
            }
         }
         $("#store-items").html(html5);
     }

     // filter category

    $("#showAll").click(function(e){
        e.preventDefault(); });

    $(".filter-btn-click").click(function(e){
        e.preventDefault();

        var valueCat=$(this).attr("data-filter");
        var valueToSend={
            value:valueCat
        };
        // console.log(valueToSend);
        ajaxCallBAck("./modals/category-filter.php", "post", valueToSend, function(result){
            writeProducts(result);
        });
    });
        
//funkcija za pretragu proizvoda
$("#search-item").keyup(function(){
    var valueSearch=$(this).val().toLowerCase();
    var valueSearchToSend={
        valueS:valueSearch
    };
    ajaxCallBAck("./modals/search.php", "post", valueSearchToSend, function(result){
        writeProducts(result);
    });
});

 //messages
 $(document).on("click", "#buttonSubmit", function(e){
    e.preventDefault();
    var valid=true;

    var valueMesage=$("#messageInput");
    var idUSer=$("#messageLogesIn").val();

    var messageRegex=/^[A-ZČĆŽŠĐ][a-zčćžšđ\s\.,!?]{11,300}$/; 

    //funkcija za proveru regexa
    function formCheck(inputValue, errorSpan, text, regex){
        if(inputValue.val()==""){
            valid=false;
            inputValue.addClass("error");
            $(errorSpan).html("You need to fill out this field.");
        }
        else{
            if(!regex.test(inputValue.val())){
                valid=false;
                inputValue.addClass("error");
                $(errorSpan).html(text);
            }
            else{
                inputValue.removeClass("error");
                $(errorSpan).html("");
            }
        }
    }



    //message
    formCheck(valueMesage, "#errorMsg", "Message must have at least 12 letters with first letter upper case.", messageRegex);
    
    if(valid){  
        var dataToSend={
            'message':valueMesage.val(),
            'userId':idUSer
        }
    }

    $.ajax({
        url:"modals/messagesForm.php",
        method:"post",
        dataType:"json",
        data:dataToSend,
        success:function(result){
            $("#done").html(result);
        },
        error:function(xhr){
            // $("#done").html(xhr.responseText); 
            console.log(xhr);
        }
    })
 });

 // delete message funx
 if(document.URL.includes("messages.php")){
    $(document).on("click", ".idDelete", function(e){
        e.preventDefault();
        var idMessage=$(this).attr("data-id");
        var idToSend={
            id:idMessage
        }

        ajaxCallBAck("modals/deleteMessage.php", "post", idToSend, function(result){
           writeMsgAfterDelete(result);
         });
     })
     
     // write remaining messages
     function writeMsgAfterDelete(arrayMsg){
         var html9="";
         var rb=1;
         html9+=`<table class="table">
         <thead>
           <tr>
             <th scope="col">#</th>
             <th scope="col">First Name</th>
             <th scope="col">Last Name</th>
             <th scope="col">Email</th>
             <th scope="col">Message</th>
           </tr>
         </thead>
         <tbody>`;
         for(var obj9 of arrayMsg){
             html9+=`<tr>
             <th scope="row">${rb}</th>
             <td>${obj9.name_user}</td>
             <td>${obj9.last_name}</td>
             <td>${obj9.email_user}</td>
             <td>${obj9.message_user}</td>
             <td><a href="#" data-id="${obj9.id_msg}" class="idDelete">Delete</a></td>
           </tr>`
           rb++;
         }
         html9+=`</tbody>
         </table>`;
         $("#messages").html(html9);
     }
}


// menu functions
if(document.URL.includes("menu.php")){
    //delete menu
    $(document).on("click", ".deleteMenu", function(e){
        e.preventDefault();
        var dataMenu=$(this).attr("data-id");
        var dataToSendM={
            dataMenu:dataMenu
        }

        ajaxCallBAck("modals/deleteMenu.php", "post", dataToSendM, function(result){
            writeMenu(result);
        });
    })
    function writeMenu(arrayMenu){
        var html10="";
        html10+=`<table class="table"> 
        <thead>
          <tr>
            <th scope="col">id_menu</th>
            <th scope="col">name_menu</th>
            <th scope="col">href_menu</th>
            <th scope="col">show_menu</th>
            <th scope="col">priority_menu</th>
          </tr>
        </thead>
        <tbody>`;
        for(var obj10 of arrayMenu){
            html10+=`<tr>
            <th scope="row">${obj10.id_menu}</th>
            <td><input type="text" id="nameMenu${obj10.id_menu}" class="form-control" value="${obj10.name_menu}"></td>
            <td><input type="text" id="hrefMenu${obj10.id_menu}" class="form-control" value="${obj10.href_menu}"></td>
            <td><input type="text" id="showMenu${obj10.id_menu}" class="form-control" value="${obj10.show_menu}"></td>
            <td><input type="text" id="priorityMenu${obj10.id_menu}" class="form-control" value="${obj10.priority_menu}"></td>
            <td><a href="#" data-id="${obj10.id_menu}" class="updateMenu">Update</a></td>
            <td><a href="#" data-id="${obj10.id_menu}" class="deleteMenu">Delete</a></td>
          </tr>`
        }
        html10+=` </tbody>
        </table`;
        $("#menu").html(html10);
    }
    //update menu
    $(document).on("click", ".updateMenu", function(e){
        e.preventDefault();
        var dataMenu=$(this).attr("data-id");
        var nameMenu=$("#nameMenu"+dataMenu).val();
        var hrefMenu=$("#hrefMenu"+dataMenu).val();
        var showMenu=$("#showMenu"+dataMenu).val();
        var priorityMenu=$("#priorityMenu"+dataMenu).val();

        var dataToSendM={
            dataMenu:dataMenu,
            nameMenu:nameMenu,
            hrefMenu:hrefMenu,
            showMenu:showMenu,
            priorityMenu:priorityMenu
        }

        ajaxCallBAck("modals/updateMenu.php", "post", dataToSendM, function(result){
            writeMenu(result);
          });
    })
    //insert menu
    $(document).on("click", "#insertMenu", function(e){
       e.preventDefault();
       var nameMenu=$("#nameMenu").val();
       var hrefMenu=$("#hrefMenu").val();
       var showMenu=$("#showMenu").val();
       var priorityMenu=$("#priorityMenu").val();
       var valid=true;

       if(nameMenu=="" || hrefMenu=="" || showMenu=="" || priorityMenu==""){
           valid=false;
        }
       else{
           valid=true;
        }

        if(valid){
            var dataToSendM={
                nameMenu:nameMenu,
                hrefMenu:hrefMenu,
                showMenu:showMenu,
                priorityMenu:priorityMenu
            }
        }
       
    ajaxCallBAck("modals/insertMenu.php", "post", dataToSendM, function(result){
        alert(result);
        location.reload();
    });

    })
}

//users funx
if(document.URL.includes("users.php")){
    //delete user
    $(document).on("click", ".deleteUser", function(e){
        e.preventDefault();
        var dataUser=$(this).attr("data-id");
        var dataToSendU={
            dataUser:dataUser
        }

        ajaxCallBAck("modals/deleteUser.php", "post", dataToSendU, function(result){
            writeUsers(result);
        });
    })

    function writeUsers(arrayUsers){
        var html13="";
        html13+=`<table class="table"> 
        <thead>
          <tr>
          <th scope="col">id_user</th>
          <th scope="col">name</th>
          <th scope="col">last name</th>
          <th scope="col">email</th>
          <th scope="col">role</th>
          <th scope="col">time</th>
          </tr>
        </thead>
        <tbody>`;
        for(var obj13 of arrayUsers){
            html13+=`
            <tr>
                <th scope="row">${obj13.id_user}</th>
                <td id="nameUser${obj13.id_user}">${obj13.name_user}</td>
                <td id="lastNameUser${obj13.id_user}">${obj13.last_name}</td>
                <td id="emailUser${obj13.id_user}">${obj13.email_user}</td>
                <td id="roleUser${obj13.id_user}">${obj13.role}</td>
                <td><input type="text"  class="form-control" id="timeUser${obj13.id_user}" value="${obj13.time_register}" disabled/></td>
                <td>
                    </div>
                  </div>
                </div>
            </td>
            <td><a href="#" data-id="<?=$u->id_user?>" class="deleteUser">Delete</a></td>
          </tr>`
        }
        html13+=` </tbody>
        </table`;
        $("#users").html(html13);
    }
}


//roles funx
if(document.URL.includes("roles.php")){
    //delete role
    $(document).on("click", ".deleteRole", function(e){
        e.preventDefault();
        var dataRole=$(this).attr("data-id");
        var dataToSendR={
            dataRole:dataRole
        }

        ajaxCallBAck("modals/deleteRole.php", "post", dataToSendR, function(result){
           writeRoles(result);
        });
    })
    function writeRoles(arrayRoles){
        var html13="";
        html13+=`<table class="table"> 
        <thead>
          <tr>
            <th scope="col">id_roles</th>
            <th scope="col">role</th>
          </tr>
        </thead>
        <tbody>`;
        for(var obj13 of arrayRoles){
            html13+=`<tr>
            <th scope="row">${obj13.id_roles}</th>
            <td><input type="text" id="nameRole${obj13.id_roles}" class="form-control" value="${obj13.role}"></td>
            <td><a href="#" data-id="${obj13.id_roles}" class="updateRole">Update</a></td>
            <td><a href="#" data-id="${obj13.id_roles}" class="deleteRole">Delete</a></td>
          </tr>`
        }
        html13+=` </tbody>
        </table`;
        $("#roles").html(html13);
    }
    //update role
    $(document).on("click", ".updateRole", function(e){
        e.preventDefault();
        var dataRole=$(this).attr("data-id");
        var nameRole=$("#nameRole"+dataRole).val();
        var dataToSendR={
            dataRole:dataRole,
            nameRole:nameRole,
        }

        ajaxCallBAck("modals/updateRoleUser.php", "post", dataToSendR, function(result){
            writeRoles(result);
        });
    })
    //insert role
    $(document).on("click", "#insertRole", function(e){
       e.preventDefault();
       var nameRole=$("#nameRole").val();
       var valid=true;

       if(nameRole==""){
           valid=false;
        }
       else{
           valid=true;
        }

        if(valid){
            var dataToSendR={
                nameRole:nameRole,
            }
        }
       
    ajaxCallBAck("modals/insertRole.php", "post", dataToSendR, function(result){
        alert(result);
        location.reload();
    });
    })
}


//register
$(document).on("click", "#buttonSubmitR", function(e){

    console.log("aslpdk");
    e.preventDefault();
    var validR=true;
    var valueFistNameR=$("#nameInputR");
    var valueLastNameR=$("#lastNameInputR");
    var valueEmailR=$("#emailInputR");
    var valuePassR=$("#passInputR");
    
    var fullNameRegexR=/^[A-ZČĆŽŠĐ][A-Za-zčćžšđ\s]{2,15}$/;
    var eMailRegexR=/^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,3})$/;
    var passRegexR=/^.{6,30}$/; 

    //funkcija za proveru regexa
    function formCheckR(inputValueR, errorSpanR, textR, regexR){
        if(inputValueR.val()==""){
            validR=false;
            inputValueR.addClass("error");
            $(errorSpanR).html("You need to fill out this field.");
        }
        else{
            if(!regexR.test(inputValueR.val())){
                validR=false;
                inputValueR.addClass("error");
                $(errorSpanR).html(textR);
            }
            else{
                inputValueR.removeClass("error");
                $(errorSpanR).html("");
            }
        }
    }
    //firstName
    formCheckR(valueFistNameR, "#errorFirstNameR", "Name not in a good format - start with upper case leading up to at least 3 letters." ,fullNameRegexR);

    //lastName
    formCheckR(valueLastNameR, "#errorLastNameR", "Last name not in a good format - start with upper case leading up to at least 3 letters.", fullNameRegexR);

    //email
    formCheckR(valueEmailR, "#errorEmailR", "Please enter a valid email address.", eMailRegexR);

    //message
    formCheckR(valuePassR, "#errorPassR", "Password not in a good format - it must have at least 6 charachters.", passRegexR);
    
    if(validR){   
        var dataToSendR={
            firstNameR: valueFistNameR.val(),
            lastNameR: valueLastNameR.val(),
            emailR: valueEmailR.val(),
            passR: valuePassR.val()
        }
    }

    $.ajax({
        url:"./modals/registerForm.php",
        method:"post",
        dataType:"json",
        data:dataToSendR,
        success:function(result){
            $("#doneR").html(result);
        },
        error:function(xhr){
            // $("#doneR").html(xhr.responseText);
            console.log(xhr);
        }
    })
 });

 //login
 $("#buttonSubmitL").click(function(e){
    e.preventDefault();
    
    var validL=true;
    var valueEmailL=$("#emailInputL");
    var valuePassL=$("#passwordInputL");
    
    var eMailRegexL=/^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,3})$/;
    var passRegexL=/^.{6,30}$/; 

    // regex checker
    function formCheckL(inputValueL, errorSpanL, textL, regexL){
        if(inputValueL.val()==""){
            validL=false;
            inputValueL.addClass("error");
            $(errorSpanL).html("You need to fill out this field.");
        }
        else{
            if(!regexL.test(inputValueL.val())){
                validL=false;
                inputValueL.addClass("error");
                $(errorSpanL).html(textL);
            }
            else{
                inputValueL.removeClass("error");
                $(errorSpanL).html("");
            }
        }
    }
    //email
    formCheckL(valueEmailL, "#errorEmailL", "Please enter a valid email address.", eMailRegexL);

    //message
    formCheckL(valuePassL, "#errorPassL", "Password not in a good format - it must have at least 6 charachters.", passRegexL);
    
    if(validL){   
        var dataToSendL={
            emailL: valueEmailL.val(),
            passL: valuePassL.val()   
        }   
    }

    $.ajax({
        url:"./modals/loginForm.php",
        method:"post",
        dataType:"json",
        data:dataToSendL,
        success:function(result){
            if(result=="Welcome - you have successfully logged in."){
                window.location.href="index.php";
            }
            $("#doneL").html(result);
        },
        error:function(xhr){
            console.log(xhr);
        }
    })
 });

 //categories funx
 if(document.URL.includes("categories.php")){
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

//products funx ap
if(document.URL.includes("products.php")){
    //delete product
    $(document).on("click", ".deleteProduct", function(e){
        e.preventDefault();
        var dataProduct=$(this).attr("data-id");
        var dataToSendP={
            dataProduct:dataProduct
        }

        ajaxCallBAck("modals/deleteProduct.php", "post", dataToSendP, function(result){
            writeProducts(result.products, result.cat);
        });
    })
    function writeProducts(arrayProducts, arrayCat){
        var html14="";
        html14+=`<table class="table"> 
        <thead>
        <tr>
            <th scope="col">id_products</th>
            <th scope="col">price</th>
            <th scope="col">name_products</th>
            <th scope="col">picture_src</th>
            <th scope="col">change src</th>
            <th scope="col">name_cat</th>
        </tr>
        </thead>
        <tbody>`;
        for(var obj14 of arrayProducts){
            html14+=`<tr>
                        <th scope="row">${obj14.id}</th>
                        <td><input type="text" id="nameProducts${obj14.id}" class="form-control" value="${obj14.name}"></td>
                        <td><input type="text" id="nameProducts${obj14.id}" class="form-control" value="${obj14.cena}"></td>
                        <td><input type="text" id="srcProducts${obj14.id}" class="form-control" value="${obj14.src}" disabled></td>
                        <td><input type="file" id="fileProducts${obj14.id}" class="form-control-file"></td>
                        <td>

                        <div class="form-group">
                        <select class="form-select product${obj14.id}" aria-label="Default select example">`
            for(var obj15 of arrayCat){
                if(obj14.kategorija_id == obj15.id_cat){
                html14+=`<option selected value="${obj15.id}">${obj15.name}</option>`
            } else {
                html14+=`<option value="${obj15.id_cat}">${obj15.name_cat}</option>`
            }
            }
            html14+=` </select>
            </div>
            </td>
            <td><a href="#" data-id="${obj14.id}" class="updateProduct">Update</a></td>
            <td><a href="#" data-id="${obj14.id}" class="deleteProduct">Delete</a></td>
          </tr>`
        }
        html14+=` </tbody>
        </table`;
        $("#productss").html(html14);
    }
    //update products
    $(document).on("click", ".updateProduct", function(e){
        e.preventDefault();
        var dataProducts=$(this).attr("data-id");
        var nameProducts=document.getElementById("nameProducts"+dataProducts).value;
        var cenaProducts=document.getElementById("cenaProducts"+dataProducts).value;
        var catValue=$(".product"+dataProducts).val();
        console.log(catValue)
        var filePicture=document.getElementById("fileProducts"+dataProducts).files[0];
        var srcProducts=document.getElementById("srcProducts"+dataProducts).value;
        var picture;
        var valid=true;

        if(nameProducts==""){
            valid=false;
        }
        else{
            valid=true;
        }   
        if(filePicture==undefined){
            picture=srcProducts;
        }
        else{
            picture=filePicture;
        } 

        if(valid){
            var dataToSend=new FormData();
            dataToSend.append("dataProducts",dataProducts) 
            dataToSend.append("nameProducts",nameProducts)
            dataToSend.append("cenaProducts",cenaProducts) 
            dataToSend.append("catValue",catValue) 
            dataToSend.append("filePicture",picture) 
           }

           $.ajax({
            url:"modals/updateProduct.php",
            method:"post",
            dataType:"json",
            data:dataToSend,
            processData:false,
            contentType:false,
            success:function(result){
                alert(result.msg);
                writeProducts(result.products, result.cat);
            },
            error:function(xhr){
               console.log(xhr);
            }
        });
    })

    $(document).on("change", "#catInsert", function(){
        var catValueInsert=document.getElementById("catInsert").value;
    })
    //insert product
    $(document).on("click", "#insertProduct", function(e){
       e.preventDefault();
       var nameProduct=document.getElementById("nameProduct").value;
       var cenaProduct=document.getElementById("priceProduct").value;
       var catValue=$(".catInsert").val();
       var filePicture=document.getElementById("fileProducts").files[0];
       var valid=true;

       if(nameProduct==""){
           valid=false;
            if(!delivery=="0" && !delivery=="1"){
                valid=false;
                $("#error").html("Please select delivery or not delivery");
            }
            else{
                valid=true;
            }
            if(catValue=="0" || artistValue=="0"){
                valid=false;
            }
            else{
                valid=true;
            }
        }
        else{
            valid=true;            
        }
       
       if(valid){
        var dataToSendP=new FormData();
        dataToSendP.append("filePicture",filePicture) 
        dataToSendP.append("nameProduct",nameProduct)
        dataToSendP.append("cenaProduct",cenaProduct)  
        dataToSendP.append("catValue",catValue)
       }
           
       $.ajax({
        url:"modals/insertProduct.php",
        method:"post",
        dataType:"json",
        data:dataToSendP,
        processData:false,
        contentType:false,
        success:function(result){
            alert(result);
        location.reload();
        },
        error:function(xhr){
            console.log(xhr);
        }
    });
    })
}

// order funx

$(document).on("click", "#buttonOrderBooyah", function(e){
    e.preventDefault();
    var loggedIn = $("#loggedIn");
    var validR=true;
    var valueAddressOrder=$("#adresaId");
    var valuePhoneOrder=$("#phoneId");
    var valueFoodOrder=$("#foodNameId");
    
    var addressRegexR=/[^A-Za-z0-9]+/;
    var phoneRegexR=/^([0-9]{0,9})\s?([0-9]{0,9})\s?([0-9]{0,9})$/;

    // regex funx
    function formCheckR(inputValueR, errorSpanR, textR, regexR){
        if(inputValueR.val()==""){
            validR=false;
            inputValueR.addClass("error");
            $(errorSpanR).html("You need to fill out this field.");
        }
        else{
            if(!regexR.test(inputValueR.val())){
                validR=false;
                inputValueR.addClass("error");
                $(errorSpanR).html(textR);
            } 
            else{
                inputValueR.removeClass("error");
                $(errorSpanR).html("");
            }
        }

        if(valueFoodOrder.val()==0)
            {
                validR=false;
                $("#foodNameId").addClass("error");
                $("#errorFoodR").html("Please choose one from the menu in dropdown list.");
            }
            else {
                $("#foodNameId").removeClass("error");
                $("#errorFoodR").html("");
            }
    }
    //address
    formCheckR(valueAddressOrder, "#errorAddressR", "Address not in good format. Please input the real address." ,addressRegexR);

    //phone
    formCheckR(valuePhoneOrder, "#errorPhoneR", "Use the right telephone format  - '(123 123 123)'", phoneRegexR);


    if(valueFoodOrder.val() == 0){
        validR = false;
    }
    
    if(validR){   
        var dataToSendR={
            address: valueAddressOrder.val(),
            phone: valuePhoneOrder.val(),
            food: valueFoodOrder.val(),
            loggedIn: loggedIn.val()
        }
    }

    $.ajax({
        url:"./modals/orderForm.php",
        method:"post",
        dataType:"json",
        data:dataToSendR,
        success:function(result){
            $("#orderDone").html(result);
        },
        error:function(xhr){
           // $("#orderDone").html(xhr.responseText);
            //console.log(xhr);
        }
    })
 });

});