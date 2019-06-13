use gearsport;
CREATE TABLE account(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sid VARCHAR(13) NOT NULL,
    uni VARCHAR(7) NOT NULL,
    fname VARCHAR(128) NOT NULL,
    lname VARCHAR(128) NOT NULL,
    email VARCHAR(256) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    img_url text,
    details JSON,
    CHECK (JSON_VALID(details)),
    UNIQUE KEY (email),
    UNIQUE KEY (sid)
);

CREATE TABLE account_uni(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    uni VARCHAR(7) NOT NULL,
    uni_full_name VARCHAR(100) NOT NULL,
    uni_pwd VARCHAR(255) NOT NULL,
    UNIQUE KEY(uni)
);