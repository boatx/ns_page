$( document ).ready(function() {

    var changeImg=function(time,arg){
        var pre=act;
        if (arg)
        {
            act=arg;
        }
        else
        {
            act=(act+1) % size;
        }
        //imgArray[act].show();
        imgArray[act].css('z-index',1);
        imgArray[pre].css('z-index',0);
        imgArray[act].fadeIn(time,'swing',function(){
            imgArray[pre].css('display','none');
            imgArray[act].css('display','block');
        });
        radArray[act].prop('checked',true);
    }

    var conDiv = jQuery('<div/>', {id: 'control'});
    var imgArray=[];
    var radArray=[];
    var i=0;
    $('#slider').children('div').each(function(){
        imgArray.push($(this));
        radArray.push(jQuery('<input/>',{type:'radio',name:'control',value:i,id:"a"+i}));
        radArray[i].change(function(){changeImg(1000,this.value)});
        conDiv.append(radArray[i]);
        conDiv.append('<label for="a'+i+'"><span></span></label>');
        i=i+1;
    });
    $('#slider').append(conDiv);
    var act=0;
    var size=imgArray.length;
    changeImg(0);
    var time=800;
    setInterval(changeImg,40*1000);
});
