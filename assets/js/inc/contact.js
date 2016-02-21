function Contact(){
      var self=this;
      this.Validator = $('#contactForm');
      
      this.roles = {
            rules: {
                  firstname: {
                     required: true,
                     textOnly: true
                     },
                 lastname: {
                     required: true,
                     textOnly: true
                     },
                 email: {
                     required: true,
                     email:true,
                     remote: {
                         url: "check-email.php",
                         type: "post",
                         data: {
                           usrmail: function() {
                             return $( "#email" ).val();
                           }
                         }
                       }
                     },
                 password: {
                     required: true,
                     },
                 confirmpassword: {
                     
                     equalTo: "#password"
                     },
                 fileToUpload: {
                     required: true,
                     accept: "image/jpeg"
                     }
            }
      };
      
      this.messages = {
            firstname : "Required and Text Only Field",
            lastname : "Required and Text Only Field",
            email:{remote:"Email Not Available"},
            password : "Required Field",
            confirmpassword : "Has to match password Field",
            fileToUpload : "Only jpg format is accepted",
      };
      
      this.init = function(){
            
            $.validator.addMethod("textOnly", 
                  function(value, element) {
                      return /[a-zA-Z ]/.test(value);
                    }, 
                    "Alpha Characters Only."
            );
            
            $("#contactForm").validate(self.roles,self.messages);
            
      }
}