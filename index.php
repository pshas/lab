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
                        <div class="title">
                            <h4>${block.title}</h4>
                        </div>
                        <div class="description">
                            <p>${block.description}</p>
                        </div>
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

<style>
    /* Общие стили */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f5f5f5;
    }
    
    #content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 8px;
    }
    
    /* Кнопки */
    button {
        padding: 10px 15px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s;
    }
    
    button:hover {
        background-color: #45a049;
    }
    
    #addBlock {
        margin: 20px 0;
        background-color: #2196F3;
    }
    
    #addBlock:hover {
        background-color: #0b7dda;
    }
    
    /* Контейнер блоков */
    #blocks-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    /* Стили для блоков лабораторий */
    .block {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 15px;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
    }
    
    .block:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .block h4 {
        margin-top: 0;
        color: #333;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    
    .block p {
        color: #666;
        margin-bottom: 20px;
    }
    
    /* Кнопки в блоках */
    .order-btn {
        display: inline-block;
        padding: 8px 12px;
        background-color: #2196F3;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        margin-bottom: 10px;
    }
    
    .order-btn:hover {
        background-color: #0b7dda;
    }
    
    .remove-btn {
        display: inline-block;
        padding: 8px 12px;
        background-color: #f44336;
        color: white;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }
    
    .remove-btn:hover {
        background-color: #d32f2f;
    }
    
    /* Модальное окно */
    #modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        z-index: 1000;
        width: 400px;
        max-width: 90%;
    }
    
    #modal h3 {
        margin-top: 0;
        color: #333;
    }
    
    #modal label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }
    
    #modal input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }
    
    #modal button {
        margin-right: 10px;
    }
    
    #cancel {
        background-color: #f44336;
    }
    
    #cancel:hover {
        background-color: #d32f2f;
    }
</style>
