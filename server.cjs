const express = require('express');
const multer = require('multer');
const path = require('path');

const app = express();
const upload = multer({ dest: 'uploads/' });

app.use(express.static(path.join(__dirname, 'uploads')));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// API để tải lên ảnh
app.post('/upload', upload.single('image'), (req, res) => {
    if (!req.file) {
        return res.status(400).send('No file uploaded.');
    }
    res.json({ imageUrl: `/uploads/${req.file.filename}` });
});

// Khởi chạy server
/*
const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server running at http://localhost:${PORT}`);
});
*/
const PORT = 3001; // Chọn cổng khác
app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});

