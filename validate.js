
function Validateentries(id, name, email, phone, image) {
    let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let nameformat = /^[A-Za-z\s]+$/;
    let phonenoformat = /^\d{10}$/;
    let imageformat = /(\.jpg|\.jpeg|\.png|\.gif)$/i;


    if (!name.value.match(nameformat)) {
        alert('Please enter your name properly');
        document.form1.Name.focus();
        return false;
    }

    if (!email.value.match(mailformat)) {
        alert("You have entered an invalid email address!");
        document.form1.email.focus();
        return false;
    }

    if (!phone.value.match(phonenoformat)) {
        alert("Please input the phone number of 10 digits ");
        return false;
    }

    if (sid == NULL) {
        if (!imageformat.exec(image.value)) {
                alert("Please choose valid image format files (.jpg, .jpeg, .png, .gif");
            image.value = '';
            return false;
        }
    }

    return true;
}

