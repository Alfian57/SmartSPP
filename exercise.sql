-- 
-- 
-- 
-- 1. query store procedure untuk insert table siswa, table akun, dan tagihan secara bersamaan
-- 
DELIMITER / / CREATE PROCEDURE insert_siswa_akun_tagihan (
    IN p_siswa_id CHAR(36),
    IN p_nisn CHAR(10),
    IN p_nama VARCHAR(100),
    IN p_jenis_kelamin ENUM ('laki-laki', 'perempuan'),
    IN p_tanggal_lahir DATE,
    IN p_agama ENUM (
        'islam',
        'kristen',
        'katholik',
        'hindu',
        'budha',
        'konghuchu'
    ),
    IN p_status ENUM ('yatim-piatu', 'yatim', 'piatu', 'none'),
    IN p_no_telepon VARCHAR(25),
    IN p_alamat TEXT,
    IN p_id_kelas CHAR(36),
    IN p_id_orang_tua CHAR(36),
    IN p_akun_id CHAR(36),
    IN p_email VARCHAR(100),
    IN p_tagihan_id CHAR(36)
) BEGIN
-- Insert into siswa table
INSERT INTO
    siswa (
        id,
        nisn,
        nama,
        jenis_kelamin,
        tanggal_lahir,
        agama,
        status,
        no_telepon,
        alamat,
        id_kelas,
        id_orang_tua,
        created_at,
        updated_at
    )
VALUES
    (
        p_siswa_id,
        p_nisn,
        p_nama,
        p_jenis_kelamin,
        p_tanggal_lahir,
        p_agama,
        p_status,
        p_no_telepon,
        p_alamat,
        p_id_kelas,
        p_id_orang_tua,
        NOW (),
        NOW ()
    );

-- Insert into akun table
INSERT INTO
    akun (
        id,
        email,
        password,
        accountable_id,
        accountable_type,
        created_at,
        updated_at
    )
VALUES
    (
        p_akun_id,
        p_email,
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        p_siswa_id,
        'App\\Models\\Siswa',
        NOW (),
        NOW ()
    );

-- Insert into tagihan table
INSERT INTO
    tagihan (
        id,
        nominal,
        bulan,
        tahun_ajaran,
        diskon,
        id_siswa,
        status,
        created_at,
        updated_at
    )
VALUES
    (
        p_tagihan_id,
        1000000,
        MONTHNAME (CURDATE ()),
        CONCAT (YEAR (CURDATE ()), '-', YEAR (CURDATE ()) + 1),
        0,
        p_siswa_id,
        'belum-dibayar',
        NOW (),
        NOW ()
    );

END / / DELIMITER;

-- 
-- 
-- 
-- 2. query store procedure untuk insert table admin, dan table akun secara bersamaan
-- 
DELIMITER / / CREATE PROCEDURE insert_admin_akun (
    IN p_admin_id CHAR(36),
    IN p_nama VARCHAR(100),
    IN p_akun_id CHAR(36),
    IN p_email VARCHAR(100)
) BEGIN
-- Insert into admin table
INSERT INTO
    admin (id, nama, created_at, updated_at)
VALUES
    (p_admin_id, p_nama, NOW (), NOW ());

-- Insert into akun table
INSERT INTO
    akun (
        id,
        email,
        password,
        accountable_id,
        accountable_type,
        created_at,
        updated_at
    )
VALUES
    (
        p_akun_id,
        p_email,
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        p_admin_id,
        'App\\Models\\Admin',
        NOW (),
        NOW ()
    );

END / / DELIMITER;

-- 
-- 
-- 
-- 3. query untuk menampilkan laporan dengan menggunakan query agregat (akan ada 2, untuk export data semua kelas dan persiswa)
-- a. Semua kelas
SELECT
    classrooms.name AS classroom,
    COUNT(DISTINCT students.id) AS number_of_students,
    SUM(bills.nominal) AS total_bills,
    SUM(
        CASE
            WHEN payments.status = 'tervalidasi' THEN payments.nominal
            ELSE 0
        END
    ) AS total_validated_payments,
    SUM(bills.diskon) AS total_discounts,
    SUM(bills.nominal) - SUM(
        CASE
            WHEN payments.status = 'tervalidasi' THEN payments.nominal
            ELSE 0
        END
    ) - SUM(bills.diskon) AS total_remaining_bills,
    (
        SUM(
            CASE
                WHEN payments.status = 'tervalidasi' THEN payments.nominal
                ELSE 0
            END
        ) / SUM(bills.nominal)
    ) * 100 AS payment_percentage
FROM
    classrooms
    LEFT JOIN students ON students.classroom_id = classrooms.id
    LEFT JOIN bills ON bills.student_id = students.id
    LEFT JOIN payments ON payments.bill_id = bills.id
WHERE
    bills.bulan = LOWER(MONTHNAME (NOW ())) -- atau gunakan bulan yang diinginkan
    AND SUBSTRING(bills.tahun_ajaran, 1, 4) = YEAR (NOW ()) -- atau gunakan tahun yang diinginkan
GROUP BY
    classrooms.id;

-- 
-- 
-- b. Persiswa
-- Mendapatkan ID tagihan (billId)
SELECT
    tagihan.id AS bill_id,
    tagihan.nominal,
    tagihan.diskon,
    siswa.id AS student_id,
    siswa.nama AS student_name,
    siswa.*,
    IFNULL (SUM(pembayaran.nominal), 0) AS totalPaid,
    (
        tagihan.nominal - tagihan.diskon - IFNULL (SUM(pembayaran.nominal), 0)
    ) AS amountDue
FROM
    tagihan
    INNER JOIN siswa ON siswa.id = tagihan.id_siswa
    LEFT JOIN pembayaran ON pembayaran.id_tagihan = tagihan.id
    AND pembayaran.status = 'tervalidasi'
WHERE
    tagihan.id_siswa = '9c75f60a-36e3-4ea5-b576-2df24db2da44' -- 9c75f60a-36e3-4ea5-b576-2df24db2da44 Diganti ID siswa yang diinginkan
    AND YEAR (tagihan.created_at) = 2024 -- 2024 Diganti tahun yang diinginkan
    AND tagihan.bulan = 'july' -- July Diganti bulan yang diinginkan
GROUP BY
    tagihan.id,
    siswa.id
ORDER BY
    tagihan.created_at DESC
LIMIT
    1;

-- 
-- 
-- 
-- 4. query store procedure untuk update table admin dan table akun secara bersamaan
--
DELIMITER / / CREATE PROCEDURE update_admin_account (
    IN p_admin_id CHAR(36),
    IN p_new_name VARCHAR(100),
    IN p_new_email VARCHAR(100),
    IN p_new_password VARCHAR(255)
) BEGIN DECLARE v_akun_id CHAR(36);

-- Find the related account ID based on the admin ID
SELECT
    id INTO v_akun_id
FROM
    akun
WHERE
    accountable_id = p_admin_id
    AND accountable_type = 'App\Models\Admin'
LIMIT
    1;

-- Update the admin's name
UPDATE admin
SET
    nama = p_new_name
WHERE
    id = p_admin_id;

-- Update the related account's email and password
UPDATE akun
SET
    email = p_new_email,
    password = p_new_password
WHERE
    id = v_akun_id;

END / / DELIMITER;

-- Sebelum call store procedure, jalankan command dibawah ini terlebih dahulu
-- Change collation for 'admin' table
ALTER TABLE admin CONVERT TO CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Change collation for columns in 'admin' table
ALTER TABLE admin MODIFY nama VARCHAR(100) CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Change collation for 'akun' table
ALTER TABLE akun CONVERT TO CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Change collation for columns in 'akun' table
ALTER TABLE akun MODIFY email VARCHAR(100) CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci,
    MODIFY password VARCHAR(255) CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci,
    MODIFY accountable_id CHAR(36) CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci,
    MODIFY accountable_type VARCHAR(255) CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Ini untuk call store procedurenya (Namun bisa juga excecute sendiri seperti diatas)
CALL update_admin_account (
    '9c7f9c0d-0a7d-4154-b3a9-24a8141f9106',
    'Alfian Gading 2',
    'test.admin@gmail.com',
    '$2y$12$sgjy2SMtndyJTroULaZ.WO2cufMD41KTV/AOWDsZUEs1E2UCAbn8e'
);