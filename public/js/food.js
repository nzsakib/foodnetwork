

$("a.image-icon").click(function () {
  $(".new-comment input[type='file']").trigger('click');
});



$(".new-comment input[type=file]").on('change', function () {

     //Get count of selected files
     var countFiles = $(this)[0].files.length;

     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#image-holder");
     image_holder.empty();

     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {

             //loop for each file selected for uploaded.
             for (var i = 0; i < countFiles; i++) {

                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $("<img />", {
                         "src": e.target.result,
                             "class": "thumb-image"
                     }).appendTo(image_holder);
                 }

                 image_holder.show();
                 reader.readAsDataURL($(this)[0].files[i]);
             }

         } else {
             alert("This browser does not support FileReader.");
         }
     } else {
         alert("Pls select only images");
     }
 });

lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
})


// $('.ingredients ul li span.delete').on('click', function(){
//     $this = $(this);
//     var toRemove = $this.parent().text();
//     $this.parent().fadeOut().remove();
//     var toFind = "input[value='" + toRemove + "']";
//     $(toFind).remove();
//     console.log("Removed : " + toFind);
// });

$("input[name=ingred]").on('keydown', function(e) {
    if(e.keyCode == 13) {
        e.preventDefault();
        var value = $(this).val();
        $(this).val('');
        $(".ingredients form").append("<input type=\"hidden\" name=\"ingred[]\" value='"+value+"'</>");
        var newli = $(".ingredients ul").append("<li>" + value + " <span class=\"delete\"><i class=\"fa fa-times-circle-o\" aria-hidden=\"true\"></i></span></li>").children(':last').hide().fadeIn(1000);
        console.log(newli.html());
        // newli = newli.children('li').last().children('span.delete');
        newli.click(removeElement);
    }
});

function removeElement(e) {
    $this = $(this);
    console.log($this.text());
    var toRemove = $this.text();
    toRemove = toRemove.trim();
    $this.fadeOut(function() {
        $(this).remove();
    });
    var toFind = "input[value='" + toRemove + "']";
    $(toFind).remove();
    console.log("Removed : " + toFind);
}

$('button.submit-recipe').click(function(e) {
    e.preventDefault();
    $(".ingredients form").submit();
});
