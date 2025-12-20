<form id="ticketForm" enctype="multipart/form-data">

    <input name="name" placeholder="Name" required>
    <input name="phone" placeholder="+380501234567" required>
    <input name="email" placeholder="Email">
    <input name="subject" placeholder="Subject" required>
    <textarea name="message" placeholder="Message" required></textarea>
    <input type="file" name="attachment[]" multiple>
    <button type="submit">Send</button>
</form>

<div id="response"></div>

<script>
    document.getElementById('ticketForm').addEventListener('submit', async function(e){
        e.preventDefault();
        let formData = new FormData(this);

        const response = await fetch('/api/tickets', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();
        document.getElementById('response').innerText = 'Ticket ID: ' + data.id;
    });
</script>
