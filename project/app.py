from flask import Flask, render_template, request, redirect, url_for
import os

app = Flask(__name__)
app.config['UPLOAD_FOLDER'] = '/static/uploads'

# Tạo thư mục nếu chưa có
if not os.path.exists(app.config['UPLOAD_FOLDER']):
    os.makedirs(app.config['UPLOAD_FOLDER'])

# Lưu trữ danh sách bài viết
articles = []

# Trang chủ - hiển thị các bài viết
@app.route('/')
def index():
    return render_template('index.html', articles=articles)

# Trang thêm bài viết
@app.route('/add', methods=['GET', 'POST'])
def add_article():
    if request.method == 'POST':
        title = request.form['title']
        description = request.form['description']
        content = request.form['content']
        publish_date = request.form['publish_date']
        image = request.files['image']

        # Lưu ảnh nếu được tải lên
        if image and image.filename != '':
            image_path = os.path.join(app.config['UPLOAD_FOLDER'], image.filename)
            image.save(image_path)
            image_url = f"uploads/{image.filename}"
        else:
            image_url = None

        # Thêm bài viết vào danh sách
        articles.append({
            'id': len(articles) + 1,
            'title': title,
            'description': description,
            'content': content,
            'publish_date': publish_date,
            'image': image_url
        })

        return redirect(url_for('index'))

    return render_template('add_article.html')

# Trang hiển thị nội dung bài viết
@app.route('/article/<int:article_id>')
def view_article(article_id):
    article = next((a for a in articles if a['id'] == article_id), None)
    if article:
        return render_template('view_article.html', article=article)
    else:
        return "Bài viết không tồn tại!", 404
#lien ket voi html
@app.route('/run_script', methods=['GET'])
def run_script():
    # Thực hiện công việc của bạn ở đây (ví dụ: chạy một hàm Python).
    print("Script đã được thực thi")
    # Trả về một phản hồi, có thể là redirect hoặc thông báo.
    return "Script đã được thực thi!"

if __name__ == '__main__':
    app.run(debug=True)
