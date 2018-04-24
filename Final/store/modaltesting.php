<!DOCTYPE html>
<html>
<head>
<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>

<div id="questions"></div>



</head>
<body>

<h2>Modal Example</h2>

<!-- Trigger/Open The Modal -->


<script>
// Get the modal
var ajaxDisplay = document.getElementById('questions');
var html="<div class='row'>";

html+='<button id="myBtn">Open Modal</button>';
html+='<div id="myModal" class="modal">';
html+='<div class="modal-content">';
html+='<span class="close">&times;</span>';
html+='<p>Some text in the Modal..</p>';
html+='</div>';
html+='</div>';



</script>

</body>
</html>