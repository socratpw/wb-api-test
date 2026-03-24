<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WB API</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; }
        button { padding: 12px 24px; font-size: 16px; cursor: pointer; margin: 10px; }
        #result { margin-top: 20px; padding: 20px; background: #f4f4f4; white-space: pre; }
    </style>
</head>
<body>
<h1>Wildberries API</h1>

<button onclick="sendData(this)">Загрузить данные</button>

<div id="result">Нажми кнопку...</div>

<script>
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    async function sendData(btn) {
        btn.disabled = true;
        btn.textContent = 'Загрузка...';
        document.getElementById('result').textContent = 'Ждём ответа...';

        try {
            const response = await fetch('/send-data', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                }
            });

            const data = await response.json();
            document.getElementById('result').textContent = JSON.stringify(data, null, 2);

        } catch (error) {
            document.getElementById('result').textContent = 'Ошибка: ' + error.message;
        } finally {
            btn.disabled = false;
            btn.textContent = 'Загрузить данные';
        }
    }
</script>
</body>
</html>
