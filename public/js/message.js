fetch('/api/message')
    .then(res => res.json())
    .then(data => console.log(data.message));
