       // search
        function Search() {
                var input, filter, table, tr, td, i;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                  td = tr[i].getElementsByTagName("td")[0];
                  if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                      tr[i].style.display = "";
                    } else {
                      tr[i].style.display = "none";
                    }
                  }       
                }
              }

      // letters only
      function lettersOnly(input){
          var regex = /[^a-z]/gi;
          input.value = input.value.replace(regex,"");
      }

      //validation
      function validation(){

        var a = document.getElementById("password_1").value;
          
        if (a.length < 5 ) {
          document.getElementById("error").innerHTML = "Password is too short";
          return false;
        }
        else if (a.length > 15 ) {
          document.getElementById("error").innerHTML = "Password is too long";
          return false;
        }
      }  

      // show password
       function myFunction() {
                  var x = document.getElementById("password");
                  if (x.type === "password") {
                      x.type = "text";
                  } else {
                      x.type = "password";
                  }
              }


              // image modal
      var modal = document.getElementById('myModal');
       
      var img = document.getElementById('myImg');
      var modalImg = document.getElementById("img01");
      var captionText = document.getElementById("caption");
      img.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
      }
       
      var span = document.getElementsByClassName("close")[0];
       
      span.onclick = function() { 
          modal.style.display = "none";
      }

      // login validation
      function required(){

          var a = document.getElementById("email").value;
          var b = document.getElementById("password").value;    

          if (a == "" ) {
            document.getElementById("errorEmail").innerHTML = "<label class='alert alert-danger'>Email is required </label>";
            return false;
          }
          if (b == "" ) {
            document.getElementById("errorPassword").innerHTML = "<label class='alert alert-danger'> Password is required </label>";
            return false;
          }
        }  

        // send concern validation
         function error(){
          var a = document.getElementById("concern").value; 

          if (a == "") {
            document.getElementById("errorConcern").innerHTML=" Concern Message is required!";
            return false;
          } 

        }

        //print
        function printTicket() {
            window.print();
        }


        // login validation
      function required(){

          var a = document.getElementById("email").value;
          var b = document.getElementById("password").value;    
          
          if (a == "" ) {
            document.getElementById("errorEmail").innerHTML = "<label class='alert alert-danger'>Email is required </label>";
            return false;
          }
          if (b == "" ) {
            document.getElementById("errorPassword").innerHTML = "<label class='alert alert-danger'> Password is required </label>";
            return false;
          }
        }  


        function passReq(){
          var p = document.getElementById("user_password").value; 

          if (p == "" ) {
            document.getElementById("errorPwd").innerHTML = "Password is required!";
            return false;
          } 
        } 

        function reqPass(){
          var p = document.getElementById("users_password").value; 

          if (p == "" ) {
            document.getElementById("errorPwd").innerHTML = "Password is required!";
            return false;
          } 
        } 