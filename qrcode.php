<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Style for Pop-up Container */
.popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

.popup-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}

/* Style for the Trigger Button */
.popup-button {
    background-color: #007BFF;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
}

    </style>
</head>
<body>
           <!-- Pop-up Trigger Button -->
           <button id="showPopup">Show Pop-up Ad</button>

<!-- Pop-up Ad Container -->
<div id="popupContainer" class="popup">
    <div class="popup-content">
        <span class="close" id="closePopup">&times;</span>
        <h2>Special Offer!</h2>
        <p>Don't miss our exclusive offer. Click the button below to learn more.</p>
        <a href="#" class="popup-button">Learn More</a>
    </div>
</div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get the pop-up and buttons
    var popup = document.getElementById('popupContainer');
    var showPopupButton = document.getElementById('showPopup');
    var closePopupButton = document.getElementById('closePopup');

    // Show the pop-up when the button is clicked
    showPopupButton.addEventListener('click', function() {
        popup.style.display = 'block';
    });

    // Close the pop-up when the close button is clicked
    closePopupButton.addEventListener('click', function() {
        popup.style.display = 'none';
    });
});

</script>
</html>