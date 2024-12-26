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
    rating VARCHAR(10),                -- Đánh giá khóa học (0.00 đến 5.00)
    price VARCHAR(50),                -- Giá khóa học
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









INSERT INTO major (major_img, major_code, name, description) VALUES
('https://file.unica.vn/storage/db240c65c57e0a4f35edba3312c62511cbac63cc/ai-business-1440x565-02.jpg', 'CS101', 'Công nghệ thông tin', 'Chuyên ngành về lập trình, phát triển phần mềm, và hệ thống thông tin.'),
('https://file.unica.vn/storage/db240c65c57e0a4f35edba3312c62511cbac63cc/nutrime-livestream.png', 'DS102', 'Khoa học dữ liệu', 'Phân tích, xử lý dữ liệu lớn và ứng dụng AI trong thực tế.'),
('https://file.unica.vn/storage/db240c65c57e0a4f35edba3312c62511cbac63cc/912-528-video-ai.png', 'BA103', 'Quản trị kinh doanh', 'Kỹ năng quản lý doanh nghiệp và phát triển các chiến lược kinh doanh.'),
('https://i.imgur.com/BgsXn4U.png', 'MK104', 'Marketing', 'Học cách quảng bá sản phẩm, dịch vụ và xây dựng thương hiệu.'),
('https://static.unica.vn/upload/images/2024/02/nhap-mon-co-vua-cho-nguoi-moi-bat-dau.jpg_m_1709101845.jpg', 'AI105', 'Trí tuệ nhân tạo', 'Nghiên cứu và phát triển hệ thống AI, máy học và deep learning.'),
('https://static.unica.vn/upload/images/2024/02/hoc-nhiep-anh-tu-co-ban-den-nang-cao.jpg_m_1709093106.jpg', 'IT106', 'An ninh mạng', 'Chuyên sâu về bảo mật hệ thống, phát hiện và ngăn chặn tấn công mạng.'),
('https://static.unica.vn/upload/images/2024/02/ghep-anh-chuyen-nghiep-voi-Photoshop.jpg_m_1709088307.jpg', 'GD107', 'Thiết kế đồ họa', 'Sáng tạo và thiết kế nội dung đồ họa số cho truyền thông và quảng cáo.'),
('https://example.com/img/major8.jpg', 'EN108', 'Kỹ thuật phần mềm', 'Phát triển các ứng dụng phần mềm quy mô lớn và quy trình làm việc.'),
('https://static.unica.vn/upload/images/2020/04/thumb-Tr%E1%BB%8Dn%20b%E1%BB%99%20ki%E1%BA%BFn%20th%E1%BB%A9c%20v%E1%BB%81%20Excel_m_1587721222.jpg', 'MD109', 'Y khoa', 'Học về chẩn đoán, điều trị và chăm sóc sức khỏe con người.'),
('https://static.unica.vn/upload/images/2024/02/lam-chu-photoshop-cung-huy-quan-hoa.jpg_m_1709101181.jpg', 'FIN110', 'Tài chính ngân hàng', 'Quản lý tài chính, đầu tư, và các nghiệp vụ ngân hàng hiện đại.');



INSERT INTO course_major (course_img, course_code, course_name, description, video, rating, price, major_id, teacher_name) VALUES
-- Công nghệ thông tin (major_id = 1)
('https://files.fullstack.edu.vn/f8-prod/courses/15/62f13d2424a47.png', 'CS101-01', 'Lập trình cơ bản', 'Học các khái niệm lập trình cơ bản với ngôn ngữ C++.', 20, 4.5, 1000000, 1, 'Nguyễn Văn A'),
('https://files.fullstack.edu.vn/f8-prod/courses/15/62f13d2424a47.png', 'CS101-02', 'Phát triển web toàn diện', 'Xây dựng website từ cơ bản đến nâng cao với HTML, CSS, và JavaScript.', 25, 4.7, 1500000, 1, 'Trần Thị B'),
('https://files.fullstack.edu.vn/f8-prod/courses/15/62f13d2424a47.png', 'CS101-03', 'Lập trình Java nâng cao', 'Học lập trình Java và xây dựng ứng dụng.', 18, 4.6, 1700000, 1, 'Lê Văn C'),
('https://files.fullstack.edu.vn/f8-prod/courses/15/62f13d2424a47.png', 'CS101-04', 'Cấu trúc dữ liệu và giải thuật', 'Tìm hiểu các cấu trúc dữ liệu và thuật toán cơ bản.', 22, 4.8, 1800000, 1, 'Phạm Thị D'),

-- Khoa học dữ liệu (major_id = 2)
('https://files.fullstack.edu.vn/f8-prod/courses/27/64e184ee5d7a2.png', 'DS102-01', 'Phân tích dữ liệu cơ bản', 'Sử dụng Python và Excel để phân tích dữ liệu cơ bản.', 15, 4.6, 1200000, 2, 'Hoàng Văn E'),
('https://files.fullstack.edu.vn/f8-prod/courses/27/64e184ee5d7a2.png', 'DS102-02', 'Học máy cơ bản', 'Áp dụng thuật toán máy học vào các bài toán thực tế.', 30, 4.8, 2000000, 2, 'Ngô Thị F'),
('https://files.fullstack.edu.vn/f8-prod/courses/27/64e184ee5d7a2.png', 'DS102-03', 'Trực quan hóa dữ liệu', 'Học cách trực quan hóa dữ liệu với Matplotlib và Tableau.', 18, 4.7, 1500000, 2, 'Võ Văn G'),
('https://files.fullstack.edu.vn/f8-prod/courses/27/64e184ee5d7a2.png', 'DS102-04', 'Xử lý dữ liệu lớn', 'Học cách xử lý Big Data với Apache Spark.', 25, 4.9, 2200000, 2, 'Đặng Thị H'),

-- Quản trị kinh doanh (major_id = 3)
('https://files.fullstack.edu.vn/f8-prod/courses/19/66aa28194b52b.png', 'BA103-01', 'Kỹ năng quản lý nhóm', 'Học cách quản lý và lãnh đạo nhóm hiệu quả.', 10, 4.3, 800000, 3, 'Phan Văn I'),
('https://files.fullstack.edu.vn/f8-prod/courses/19/66aa28194b52b.png', 'BA103-02', 'Chiến lược kinh doanh', 'Phân tích và xây dựng chiến lược kinh doanh cho doanh nghiệp.', 18, 4.5, 1200000, 3, 'Bùi Thị K'),
('https://files.fullstack.edu.vn/f8-prod/courses/19/66aa28194b52b.png', 'BA103-03', 'Kỹ năng thuyết trình', 'Học cách thuyết trình trước đám đông chuyên nghiệp.', 12, 4.4, 900000, 3, 'Nguyễn Thị L'),
('https://files.fullstack.edu.vn/f8-prod/courses/19/66aa28194b52b.png', 'BA103-04', 'Tài chính doanh nghiệp', 'Học cách quản lý tài chính trong doanh nghiệp.', 20, 4.6, 1400000, 3, 'Trần Văn M'),

-- Marketing (major_id = 4)
('https://files.fullstack.edu.vn/f8-prod/courses/7.png', 'MK104-01', 'Digital Marketing cơ bản', 'Học cách triển khai chiến dịch Digital Marketing.', 12, 4.4, 1000000, 4, 'Lê Thị N'),
('https://files.fullstack.edu.vn/f8-prod/courses/7.png', 'MK104-02', 'SEO và Content Marketing', 'Tối ưu hóa nội dung và công cụ tìm kiếm.', 15, 4.6, 1400000, 4, 'Phạm Văn O'),
('https://files.fullstack.edu.vn/f8-prod/courses/7.png', 'MK104-03', 'Quảng cáo trên mạng xã hội', 'Học cách chạy quảng cáo hiệu quả trên Facebook và Instagram.', 10, 4.5, 1100000, 4, 'Hoàng Thị P'),
('https://files.fullstack.edu.vn/f8-prod/courses/7.png', 'MK104-04', 'Tâm lý khách hàng', 'Hiểu tâm lý khách hàng để tăng hiệu quả marketing.', 18, 4.7, 1300000, 4, 'Ngô Văn Q'),

-- Trí tuệ nhân tạo (major_id = 5)
('https://files.fullstack.edu.vn/f8-prod/courses/21/63e1bcbaed1dd.png', 'AI105-01', 'Nhập môn AI', 'Tìm hiểu khái niệm và ứng dụng cơ bản của AI.', 20, 4.7, 1800000, 5, 'Võ Thị R'),
('https://files.fullstack.edu.vn/f8-prod/courses/21/63e1bcbaed1dd.png', 'AI105-02', 'Deep Learning cơ bản', 'Xây dựng mô hình deep learning với TensorFlow.', 25, 4.9, 2200000, 5, 'Đặng Văn S'),
('https://files.fullstack.edu.vn/f8-prod/courses/21/63e1bcbaed1dd.png', 'AI105-03', 'Xử lý ngôn ngữ tự nhiên (NLP)', 'Học các ứng dụng của NLP trong AI.', 22, 4.8, 2000000, 5, 'Phan Thị T'),
('https://files.fullstack.edu.vn/f8-prod/courses/21/63e1bcbaed1dd.png', 'AI105-04', 'AI trong thị giác máy tính', 'Tìm hiểu cách AI được sử dụng trong thị giác máy tính.', 28, 5.0, 2500000, 5, 'Bùi Văn U'),

-- Thiết kế đồ họa (major_id = 6)
('https://files.fullstack.edu.vn/f8-prod/courses/2.png', 'GD106-01', 'Photoshop cơ bản', 'Học cách chỉnh sửa ảnh chuyên nghiệp với Photoshop.', 10, 4.5, 1200000, 6, 'Nguyễn Văn A'),
('https://files.fullstack.edu.vn/f8-prod/courses/2.png', 'GD106-02', 'Thiết kế Logo', 'Tạo logo chuyên nghiệp với Illustrator.', 12, 4.6, 1400000, 6, 'Trần Thị B'),
('https://files.fullstack.edu.vn/f8-prod/courses/2.png', 'GD106-03', 'InDesign cơ bản', 'Thiết kế ấn phẩm với Adobe InDesign.', 15, 4.7, 1300000, 6, 'Lê Văn C'),
('https://files.fullstack.edu.vn/f8-prod/courses/2.png', 'GD106-04', 'Thiết kế Web', 'Xây dựng giao diện web với Figma.', 20, 4.8, 1500000, 6, 'Phạm Thị D'),

-- Tài chính cá nhân (major_id = 7)
('https://files.fullstack.edu.vn/f8-prod/courses/3.png', 'FI107-01', 'Quản lý tài chính cá nhân', 'Học cách quản lý và tối ưu hóa tài chính cá nhân.', 12, 4.4, 1000000, 7, 'Hoàng Văn E'),
('https://files.fullstack.edu.vn/f8-prod/courses/3.png', 'FI107-02', 'Đầu tư cơ bản', 'Tìm hiểu về các kênh đầu tư và chiến lược đầu tư hiệu quả.', 15, 4.6, 1500000, 7, 'Ngô Thị F'),
('https://files.fullstack.edu.vn/f8-prod/courses/3.png', 'FI107-03', 'Tiết kiệm hiệu quả', 'Học cách tiết kiệm và lập ngân sách.', 10, 4.5, 900000, 7, 'Võ Văn G'),
('https://files.fullstack.edu.vn/f8-prod/courses/3.png', 'FI107-04', 'Đầu tư chứng khoán', 'Học cách đầu tư vào thị trường chứng khoán.', 20, 4.7, 1800000, 7, 'Đặng Thị H'),

-- Kỹ năng mềm (major_id = 8)
('https://files.fullstack.edu.vn/f8-prod/courses/13/13.png', 'SS108-01', 'Kỹ năng giao tiếp', 'Phát triển kỹ năng giao tiếp hiệu quả.', 10, 4.5, 800000, 8, 'Phan Văn I'),
('https://files.fullstack.edu.vn/f8-prod/courses/13/13.png', 'SS108-02', 'Quản lý thời gian', 'Học cách quản lý thời gian tối ưu.', 8, 4.3, 700000, 8, 'Bùi Thị K'),
('https://files.fullstack.edu.vn/f8-prod/courses/13/13.png', 'SS108-03', 'Làm việc nhóm', 'Học cách làm việc nhóm hiệu quả.', 12, 4.4, 900000, 8, 'Nguyễn Thị L'),
('https://files.fullstack.edu.vn/f8-prod/courses/13/13.png', 'SS108-04', 'Tư duy sáng tạo', 'Phát triển tư duy sáng tạo.', 14, 4.6, 1000000, 8, 'Trần Văn M'),

-- Ngôn ngữ (major_id = 9)
('https://files.fullstack.edu.vn/f8-prod/courses/4/61a9e9e701506.png', 'LN109-01', 'Tiếng Anh giao tiếp', 'Học tiếng Anh giao tiếp cơ bản.', 18, 4.4, 1100000, 9, 'Lê Thị N'),
('https://files.fullstack.edu.vn/f8-prod/courses/4/61a9e9e701506.png', 'LN109-02', 'Ngữ pháp cơ bản', 'Học các cấu trúc ngữ pháp tiếng Anh cơ bản.', 20, 4.5, 1000000, 9, 'Phạm Văn O'),
('https://files.fullstack.edu.vn/f8-prod/courses/4/61a9e9e701506.png', 'LN109-03', 'Viết tiếng Anh', 'Luyện kỹ năng viết tiếng Anh.', 15, 4.6, 1200000, 9, 'Hoàng Thị P'),
('https://files.fullstack.edu.vn/f8-prod/courses/4/61a9e9e701506.png', 'LN109-04', 'Tiếng Nhật sơ cấp', 'Học các kỹ năng tiếng Nhật cơ bản.', 22, 4.7, 1300000, 9, 'Ngô Văn Q'),

-- Du lịch (major_id = 10)
('https://files.fullstack.edu.vn/f8-prod/courses/6.png', 'TR110-01', 'Hướng dẫn viên du lịch', 'Kỹ năng giao tiếp và hướng dẫn khách du lịch.', 12, 4.3, 900000, 10, 'Võ Thị R'),
('https://files.fullstack.edu.vn/f8-prod/courses/6.png', 'TR110-02', 'Lập kế hoạch du lịch', 'Lập kế hoạch cho chuyến đi hiệu quả.', 10, 4.5, 800000, 10, 'Đặng Văn S'),
('https://files.fullstack.edu.vn/f8-prod/courses/6.png', 'TR110-03', 'Khám phá văn hóa', 'Tìm hiểu văn hóa các vùng miền.', 18, 4.7, 1100000, 10, 'Phan Thị T'),
('https://files.fullstack.edu.vn/f8-prod/courses/6.png', 'TR110-04', 'Tiếng Anh du lịch', 'Học tiếng Anh chuyên ngành du lịch.', 22, 4.8, 1200000, 10, 'Bùi Văn U');
