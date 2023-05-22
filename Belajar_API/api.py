from flask import Flask, request, jsonify

app = Flask(__name__)

@app.route('/combine_names', methods=['POST'])
def combine_names():
    data = request.json  # Terima data JSON dari permintaan POST
    first_name = data['first_name']  # Ambil nama depan dari data JSON
    last_name = data['last_name']  # Ambil nama belakang dari data JSON
    full_name = first_name + ' ' + last_name  # Menggabungkan nama depan dan nama belakang
    char_count = len(full_name)  # Menghitung jumlah karakter dari nama lengkap
    return jsonify({'result': full_name, 'char_count': char_count})  # Mengirimkan hasil penggabungan dan jumlah karakter sebagai respons JSON

@app.route('/add_gmail', methods=['POST'])
def add_gmail():
    data = request.json  # Terima data JSON dari permintaan POST
    input_text = data['input_text']  # Ambil teks masukan dari data JSON
    modified_text = input_text + '@gmail.com'  # Menambahkan '@gmail.com' ke teks masukan
    return jsonify({'result': modified_text})  # Mengirimkan hasil pengubahan sebagai respons JSON

@app.route('/umurnya', methods=['POST'])
def umurnya():
    data = request.json  # Terima data JSON dari permintaan POST
    input_umur = data['umur']  # Ambil teks masukan dari data JSON
    umurnya = input_umur + ' ' + 'ini adalah umurnya'
    return jsonify({'result': umurnya})  # Mengirimkan hasil pengubahan sebagai respons JSON

if __name__ == '__main__':
    app.run()

# python api.py
