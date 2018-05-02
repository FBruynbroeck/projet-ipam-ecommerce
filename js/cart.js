/*
 * cart.js
 * Copyright (C) 2018 FBruynbroeck <francois@affinitic.be>
 *
 * Distributed under terms of the LICENCE.txt license.
 */
$(document).ready(function(){
    function getTotal(){
        $.ajax({
            type:'post',
            url:'/cart',
            data:{
              total_cart_items:"totalitems"
            },
            success:function(response) {
              $("#total_items").fadeOut(function() {
                  $("#total_items").text(response).fadeIn();
              });
            }
        });
    }
    getTotal();
    function displayInfo(){
        $("#info").text("Article ajouté");
        $("#info").addClass('show');
        setTimeout(hideInfo, 3000);
    }
    function hideInfo(){
        $("#info").removeClass('show');
    }
    $(".add_cart").click(function() {
        $.ajax({
            type:'post',
            url:'/cart',
            data:{
              id: this.id,
              add_cart_item:"additem"
            },
            success:function() {
                getTotal();
                displayInfo();
            }
        });
        return false;
    });
    $(".quantity").change(function() {
        $.ajax({
            type:'post',
            url:'/cart',
            data:{
              id: this.id,
              quantity: this.value
            },
            success:function() {
                getTotal();
                $("#reload").removeClass('d-none');
            }
        });
    });
});
