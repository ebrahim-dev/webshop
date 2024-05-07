import mysql.connector

# Vervang de onderstaande gegevens door je eigen informatie
host = "srv1162.hstgr.io"
port = "3306"
username = "u191441753_ebo_blog"
password = "Modi!2024"
database_name = "u191441753_php_blog"

# Maak verbinding met de MySQL-server
try:
    connection = mysql.connector.connect(
        host=host,
        port=port,
        user=username,
        password=password,
        database=database_name
    )

    if connection.is_connected():
        print("Verbonden met de MySQL-server")
        cursor = connection.cursor()

        # Voer een eenvoudige query uit om gegevens uit de 'categories'-tabel op te halen
        query = "SELECT * FROM categories"
        cursor.execute(query)

        # Haal alle rijen op
        rows = cursor.fetchall()

        print("\nGegevens uit de 'categories'-tabel:")
        for row in rows:
            print(row)
        # Voeg een nieuw item toe aan de 'categories'-tabel
        # new_item = {
        #     'soort': 'iphone1',
        #     'imei': '6123456789012',
        #     'serial': '987654321098765',
        #     'model': 'Samsung',
        #     'rom': 128,
        #     'ram': 8,
        #     'color': 'Silver',
        #     'features': 'New',
        #     'price': 300.0
        # }

        # insert_query = "INSERT INTO categories (soort, imei, serial, model, rom, ram, color, features, price) VALUES (%(soort)s, %(imei)s, %(serial)s, %(model)s, %(rom)s, %(ram)s, %(color)s, %(features)s, %(price)s)"

        # cursor.execute(insert_query, new_item)
        # connection.commit()

        # print("\nNieuw item toegevoegd aan de 'categories'-tabel")

    if connection.is_connected():
        print("Verbonden met de MySQL-server")
        cursor = connection.cursor()

        # Voer een eenvoudige query uit om gegevens uit de 'categories'-tabel op te halen
        query = "SELECT * FROM categories"
        cursor.execute(query)

        # Haal alle rijen op
        rows = cursor.fetchall()

        print("\nGegevens uit de 'categories'-tabel:")
        for row in rows:
            print(row)


except mysql.connector.Error as err:
    print(f"Fout: {err}")

finally:
    # Sluit de verbinding
    if connection.is_connected():
        cursor.close()
        connection.close()
        print("\nVerbinding met de MySQL-server is gesloten")
