

const nom=$('#name');
const sname=$("#txtname");
const img_name=$("#img_name");

const mail=$('#email');
const small=$("#txtmail");
const img=$("#img_mail");
const form=$("#formulaire");
const btn=$(".btn")

form.submit((e)=>{
    if(nom.val()==="" || nom.val()< 5){
        sname.text("name is not correct ");
        sname.css("display","block");
        nom.css("border","1px solid red")
        img_name.css("display","block")
    }
    else{
        nom.css("border","1px solid green");
        img_name.css("display","none")
        sname.css("display","none");
    }

    if(mail.val()<5 || mail.val()===""){
        small.text("your email is not valid");
        small.css("display","block");
        mail.css("border","1px solid red")
        img.css("display","block")
    }
    else{
        mail.css("border","1px solid green")
        img.css("display","none")
        small.css("display: ","none");
        small.text("");
        
    }

e.preventDefault();
})


console.log("bonjour a tous")


