CREATE TABLE forms(
    form_id INT AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE form_content(
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    tag_position INT,
    tag VARCHAR(30),
    tag_name VARCHAR(50),
    tag_value VARCHAR(500),
    form_id INT);

CREATE TABLE current_form(
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    tag_position INT,
    tag VARCHAR(30),
    tag_name VARCHAR(50),
    tag_value VARCHAR(500),
    form_id INT);


INSERT INTO form_content
(tag_position, tag, tag_name, tag_value, form_id)
VALUES
(1, "paragraph", '', "Тестовая форма", 1),
(2, "radio", "fruit", "Слива", 1),
(3, "radio", "fruit", "Яблоко", 1),
(4, "checkbox", 'vegetable', 'cucumber', 1),
(5, 'checkbox', 'vegetable', 'tomato', 1);

INSERT INTO form_content
(tag_position, tag, tag_name, tag_value, form_id)
VALUES
(1, "paragraph", '', "Тестовая форма", 2),
(2, "radio", "orange", "Апельсин", 2),
(3, "radio", "orange", "Мандарин", 2),
(4, "radio", "orange", "Цитрус", 2);
