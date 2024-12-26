-- Bảng users: Lưu thông tin người dùng
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,          -- Khóa chính
    username VARCHAR(50) NOT NULL UNIQUE,            -- Tên người dùng (duy nhất)
    email VARCHAR(100) NOT NULL UNIQUE,              -- Email (duy nhất)
    password VARCHAR(255) NOT NULL,                  -- Mật khẩu
    fullname VARCHAR(100) NOT NULL,                  -- Họ và tên
    gender ENUM('nam', 'nữ') NOT NULL DEFAULT 'nam', -- Giới tính (nam, nữ)
    role ENUM('admin', 'user') DEFAULT 'user',       -- Vai trò (admin hoặc user)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP   -- Ngày tạo
);

-- Bảng major: Lưu thông tin chuyên ngành
CREATE TABLE major (
    major_id INT AUTO_INCREMENT PRIMARY KEY,         -- Khóa chính
    major_img VARCHAR(255),                          -- Ảnh chuyên ngành
    major_code VARCHAR(50) NOT NULL UNIQUE,          -- Mã chuyên ngành (duy nhất)
    name VARCHAR(100) NOT NULL,                      -- Tên chuyên ngành
    description TEXT,                                -- Mô tả chuyên ngành
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP   -- Ngày tạo
);

-- Bảng course_major: Lưu thông tin các khóa học theo chuyên ngành
CREATE TABLE course_major (
    course_id INT AUTO_INCREMENT PRIMARY KEY,        -- Khóa chính
    course_img VARCHAR(255),                         -- Ảnh khóa học
    course_code VARCHAR(50) NOT NULL UNIQUE,         -- Mã khóa học (duy nhất)
    course_name VARCHAR(100) NOT NULL,               -- Tên khóa học
    description TEXT,                                -- Mô tả khóa học
    video INT NOT NULL DEFAULT 0,                    -- Số lượng video của khóa học
    rating DECIMAL(3, 2) DEFAULT 0.0,                -- Đánh giá khóa học (0.00 đến 5.00)
    price DECIMAL(10, 2) DEFAULT 0.0,                -- Giá khóa học
    major_id INT NOT NULL,                           -- Khóa ngoại liên kết bảng major
    FOREIGN KEY (major_id) REFERENCES major(major_id) ON DELETE CASCADE
);

-- Bảng user_courses: Lưu thông tin khóa học đã đăng ký của người dùng
CREATE TABLE user_courses (
    id INT AUTO_INCREMENT PRIMARY KEY,               -- Khóa chính
    user_id INT NOT NULL,                            -- Khóa ngoại liên kết bảng users
    course_id INT NOT NULL,                          -- Khóa ngoại liên kết bảng course_major
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Ngày đăng ký
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES course_major(course_id) ON DELETE CASCADE,
    UNIQUE (user_id, course_id)                      -- Một người dùng không thể đăng ký một khóa học hai lần
);
