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
    c.nama AS classroom,
    COUNT(s.id) AS number_of_students,
    SUM(b.nominal) AS total_bills,
    SUM(
        CASE
            WHEN p.status = 'tervalidasi' THEN p.nominal
            ELSE 0
        END
    ) AS total_validated_payments,
    SUM(b.diskon) AS total_discounts,
    SUM(b.nominal) - SUM(
        CASE
            WHEN p.status = 'tervalidasi' THEN p.nominal
            ELSE 0
        END
    ) - SUM(b.diskon) AS total_remaining_bills,
    (
        SUM(
            CASE
                WHEN p.status = 'tervalidasi' THEN p.nominal
                ELSE 0
            END
        ) / SUM(b.nominal)
    ) * 100 AS payment_percentage
FROM
    kelas c
    JOIN siswa s ON s.id_kelas = c.id
    JOIN tagihan b ON b.id_siswa = s.id
    LEFT JOIN pembayaran p ON p.id_tagihan = b.id
WHERE
    b.bulan = "july" -- July Diganti bulan yang diinginkan
    AND LEFT (b.tahun_ajaran, 4) = 2024 -- 2024 Diganti tahun yang diinginkan
GROUP BY
    c.nama;

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