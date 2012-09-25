use wmfo_training;
insert into settings (type, name, nvalue, Description) VALUES ("int", "min_quiz_grade", 90, "This sets the minimum percentage (in integer form, eg 90 = 90%) for students to pass the quiz. If their percentage is equal to or greater, they will receive a link to download the form. If the grade is less, they will receive the remedial training message.");
alter table users add column quizscore int(3) default -1;

