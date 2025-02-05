from flask import Flask, render_template, request

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/submit', methods=['POST'])
def submit():
    # Capture form data
    name = request.form.get('name')
    lrn = request.form.get('lrn')
    dob = request.form.get('dob')
    gender = request.form.get('gender')
    indigenous = request.form.get('indigenous')
    province = request.form.get('province')
    municipality = request.form.get('municipality')
    barangay = request.form.get('barangay')
    street = request.form.get('street')
    father_name = request.form.get('father_name')
    mother_name = request.form.get('mother_name')
    guardian_name = request.form.get('guardian_name')
    contact = request.form.get('contact')
    grade = request.form.get('grade')
    track = request.form.get('track')
    strand = request.form.get('strand')

    # Here you can process the data (e.g., save to a database)

    return f'Form submitted successfully!<br>Name: {name}<br>LRN: {lrn}<br>Gender: {gender}'

if __name__ == '__main__':
    app.run(debug=True)
