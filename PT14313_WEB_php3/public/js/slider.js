
        var mangAnh=[];
        mangAnh[0]="image/slider1.png";
        mangAnh[1]="image/slider2.png";
        var i=0;
        function nextAnh(){
            i++;
          document.getElementById("anh").src=mangAnh[i];
          if(i==mangAnh.length-1){
            i=-1;
          }
        }
        function backAnh(){
            i--;
            if(i==-1){
                i=mangAnh.length-1;
            }
             document.getElementById("anh").src=mangAnh[i];
        }
        
        
    