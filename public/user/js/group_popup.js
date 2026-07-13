document.addEventListener('DOMContentLoaded', function() {
    const groupMessageIcon = document.querySelector('.group-message-icon');
    const groupPopup = document.getElementById('groupPopup');
    const closeButton = document.querySelector('.close-btn');

    // Function to check for new group messages
    function checkForNewMessages() {
        // Simulate an AJAX call to fetch new messages
        fetch('/path/to/api/get-new-group-messages') // Update with actual API endpoint
            .then(response => response.json())
            .then(data => {
                if (data.newMessages) {
                    groupPopup.style.display = 'block';
                    console.log("Group popup displayed due to new messages.");
                }
            })
            .catch(error => console.error('Error fetching new messages:', error));
    }

    // Show the group popup
    groupMessageIcon.addEventListener('click', function() {
        console.log("Group message icon clicked.");
        groupPopup.style.display = 'block';
        console.log("Group popup displayed.");
    });

    // Close the group popup
    closeButton.addEventListener('click', function() {
        groupPopup.style.display = 'none';
        console.log("Group popup closed.");
    });

    // Check for new messages every 5 seconds
    setInterval(checkForNewMessages, 5000);
});
