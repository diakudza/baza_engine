# baza_engine


Единая точка входа с Nginx

Открываем конфиг домена и внутри секции server прописываем следующее правило:

location / {
    try_files $uri $uri/ /index.php?$args;
}