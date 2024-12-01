<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const toggleButton = document.getElementById('droptog');
    const toggleItem = document.getElementById('dropitem');


    toggleButton.addEventListener('click', function(event) {

        if (toggleItem.style.display === 'none') {
            toggleItem.style.display = 'block';
        } else {
            toggleItem.style.display = 'none';
        }

        event.stopPropagation();
    });

    toggleItem.addEventListener('click', function(event) {

        if (toggleItem.style.display === 'none') {
            toggleItem.style.display = 'block';
        } else {
            toggleItem.style.display = 'none';
        }

        event.stopPropagation();
    });



    document.addEventListener('click', function(event) {

        if (!toggleButton.contains(event.target) && !toggleItem.contains(event.target)) {
            toggleItem.style.display = 'none'; // 
        }
    });
</script>