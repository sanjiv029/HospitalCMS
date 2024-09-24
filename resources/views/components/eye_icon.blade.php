<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script>
    const togglePassword=document.querySelector('#togglePassword');
    const passwordInput=document.querySelector('#passwordInput');
    const toggleConfirmPassword=document.querySelector('#toggleConfirmPassword');
    const confirmPasswordInput=document.querySelector('#confirmPasswordInput');

    togglePassword.addEventListener('click',function(){
        const type = passwordInput.getAttribute('type')==='password' ? 'text': 'password';
        passwordInput.setAttribute('type',type);
        this.classList.toggle('fa-eye-slash');
    })
    toggleConfirmPassword.addEventListener('click', function () {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

</script>
