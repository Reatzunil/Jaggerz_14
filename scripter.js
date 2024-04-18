let menu = document.querySelector("#menu-btn");
let navbar = document.querySelector(".navbar");

menu.onclick = () => {
    navbar.classList.toggle("active");
};

window.onscroll = () => {
    navbar.classList.remove("active");
};

window.onscroll = () =>{
    navbar.classList.toogle('active');
};

document.querySelector('.btn1').addEventListener('click', function(event) {
    event.preventDefault(); 
    const targetId = this.getAttribute('href'); 
    const targetSection = document.querySelector(targetId); // Find the target section using the ID
    targetSection.scrollIntoView({ behavior: 'smooth' }); 
});

const learnMoreBtn = document.getElementById('learn-more-btn');
const additionalInfo = document.getElementById('additional-info');
    
learnMoreBtn.addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default behavior of anchor tag
    additionalInfo.classList.toggle('hidden'); // Toggle the 'hidden' class to reveal or hide the additional information
}); 


document.getElementById("reserveBtn").addEventListener("click", function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();
    // Call the function to show the modal
    showPersonDetails();
});

// Add event listener to the button
document.getElementById("reserveBtn").addEventListener("click", showPersonDetails);

// Function to show the modal
function showPersonDetails(){
    document.getElementById("personModal").style.display = "block";
}

// Function to close the modal
function closePersonDetails(){
    document.getElementById("personModal").style.display = "none";
}


function closePersonDetails(){
    document.getElementById("personModal").style.display = "none";
};


function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function() {
        var imgElement = document.createElement('img');
        imgElement.src = reader.result;
        imgElement.style.maxWidth = '100%';
        document.getElementById('image-preview').innerHTML = '';
        document.getElementById('image-preview').appendChild(imgElement);
    }
    reader.readAsDataURL(input.files[0]);
};

var adminCredentials = [
    {username:"admin1", password:"password1"},
    {username:"admin2", password:"password2"}
];
var userCredentials = [
    {username:"user1", password:"password1"},
    {username:"user2", password:"password2"}
];
var ownerCredentials = [
    {username:"owner1", password:"password1"},
    {username:"owner2", password:"password2"}
];

function Login(userType) {
    var username, password;
    var redirectPage;

    switch(userType) {
        case 'admin':
            username = document.getElementById("Username").value;
            password = document.getElementById("Password").value;
            redirectPage = "admin.php";
            break;
        case 'user':
            username = document.getElementById("userUsername").value;
            password = document.getElementById("userPassword").value;
            redirectPage = "user.html";
            break;
        case 'owner':
            username = document.getElementById("ownerUsername").value;
            password = document.getElementById("ownerPassword").value;
            redirectPage = "owner.html";
            break;
        default:
            return;
    }

    var validCredentials = false;
    switch(userType) {
        case 'admin':
            validCredentials = adminCredentials.some(function(admin) {
                return admin.username === username && admin.password === password;
            });
            break;
        case 'user':
            validCredentials = userCredentials.some(function(user) {
                return user.username === username && user.password === password;
            });
            break;
        case 'owner':
            validCredentials = ownerCredentials.some(function(owner) {
                return owner.username === username && owner.password === password;
            });
            break;
    }

    if (validCredentials) {
        window.location.href = redirectPage;
    } else {
        alert("Invalid Username or Password. Please try again.");
    }
}

