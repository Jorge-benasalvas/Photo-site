var url='http://localhost/proyecto_album/public/';
window.addEventListener("load",function () {

    

    



    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');

    //Boton de like
    function like() {
        $('.btn-like').unbind('click').click(function () {
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'image/likeRojo.png');

            $.ajax({
                url:url+'/like/'+$(this).data('id'),
                type:'GET',
                success: function (response) {
                    if(response.like){
                        console.log('Has dado like a la publicacion');
                    }else{
                        console.log('error al dar like');
                    }


                }
            });

            dislike();
        });
    }
    like();

    //Boton de dislike
    function dislike(){
        $('.btn-dislike').unbind('click').click(function () {
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',url+'image/likeNegro.png');

            $.ajax({
                url:url+'/dislike/'+$(this).data('id'),
                type:'GET',
                success: function (response) {
                    if(response.like){
                        console.log('Has dado dislike a la publicacion');
                    }else{
                        console.log('error al dar dislike');
                    }


                }
            });

            like();
        });
    }
    dislike();


    //Buscador
    $('#buscador').submit(function () {

        $(this).attr('action',url+'/perfiles/'+$('#buscador #search').val());

    });



});
