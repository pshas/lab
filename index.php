<?
require("header.php");
?> 
<body>
<div id='content'>
<div id="blocks-container">
</div>
 <button id="addBlock">Добавить лабораторию</button>
<div id="modal" style="display: none;">
	<h3>Добавить новую лабораторию</h3>
 <label for="blockTitle">Название</label> <input type="text" id="blockTitle"><br>
 <br>
 <label for="blockDescription">Описание:</label> <input type="text" id="blockDescription"><br>
 <br>
 <button id="saveBlock">Сохранить</button> <button id="cancel">Отмена</button>
</div>
    <script>
        $(document).ready(function() {
            function loadBlocks() {
                $.ajax({
                    url: 'load_blocks.php',
                    method: 'GET',
                    success: function(data) {
                    $('#blocks-container').html(data);
                }
            });
        }

        loadBlocks();

        $('#addBlock').click(function() {
            $('#modal').show();
			$(this).hide();
        });

        $('#saveBlock').click(function() {
            var title =$('#blockTitle').val();
            var description =$('#blockDescription').val();

            $.ajax({
                url: 'add_block.php',
                method: 'POST',
                data: { title: title, description: description},
                success: function(blockData) {
					console.log(blockData);
                    var block = JSON.parse(blockData);
                    $('#blocks-container').append(`
                    <div class="block" data-id="${block.id}"> 
                        <h4>${block.title}</h4>
                        <p>${block.description}</p>
						<a href="application/index.php?block_id=${block.id}" class="order-btn">Оформить</a><br />
                        <div class="remove-btn">Деактивировать</div>
                    </div>
                    `);
                    $('#modal').hide();
            		$('#blockTitle').val('');
            		$('#blockDescription').val('');
					$('#addBlock').show();
                }
            });
        });

        $('#cancel').click(function() {
            $('#modal').hide();
            $('#blockTitle').val('');
            $('#blockDescription').val('');
			$('#addBlock').show();
        });

        $(document).on('click', '.remove-btn', function() {
            const block = $(this).closest('.block');
            const blockId = block.data('id');

            $.ajax({
                url: 'remove_block.php',
                method: 'POST',
                data: { id: blockId },
                success: function() {
                    block.remove();
                }
            });
        });
    });
    </script>