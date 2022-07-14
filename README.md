# Test 2
This task is to test your skills in manipulating arrays and file handling.
In this test you will be making a CSV file of variable length, a form will ask for the
amount of data to generate. Check the requirements on how to generate the file.
The file will have the following header fields
Id, Name, Surname, Initials, Age, DateOfBirth
The data will look like this
"1","Andre","van Zuydam", "A", "33","13/02/1979"
"2","Tyron James", "Hall", "TJ", "32", "03/06/1980";
After this you will import the file into a database and output a count of all the
records imported.
## REQUIREMENTS:
1) Create two arrays, one for names and one for surnames. There should be
20 Names and 20 Surnames in each array. Use these arrays to generate
random names, ages & birthdates to populate a CSV file. The initials are
the first character of the name always. Write a function to perform the
task of creating the CSV file, you should pass it the number of variations
you need.
2) The CSV file should be outputted to an output folder, the name of the file
must be output.csv.
3) An input field will take the amount of records to
be generated.
4) There should be NO DUPLICATE ROWS IN THE CSV. I.e. The name,
surname, age, date of birth must be unique.
5) Output a CSV file of 1 000 000 records.
6) Import the file using a form variable of file type. One should browse for
the file and upload it to the website.
7) Create a table called “csv_import” with the relevant fields and types to
hold the data of the CSV file. Use code to create the table.
## PASS:
* The file is outputted to the correct folder with the correct name, with the
correct number of records.
* IE: A 100 record file will have 101 lines to include the headers.
* The code will have the correct arrays of Names and Surnames.
* The file is generated according to the specification of no duplicate rows.
* All the instructions are completed 1 - 7.

## FAIL:
* The data imported to the database is not correct (check dates)
* There are duplicate rows in the CSV file
* The test file to generate 1000 000 fails for whatever reason.
* The import of this large file fails for whatever reason.

## Installation

* Needs composer to be installed, for windows
 https://getcomposer.org/Composer-Setup.exe

1) Clone the repo:
```
git clone https://github.com/kwanda9700/ devProx_test2.git Test2
```

2) Create `.env` file from the `.env.example` file by running this in the terminal:
```
composer run-script post-root-package-install
```

3) Setup database credentials on the `.env` and create a database on phpMyAdmin

4) Update Composer
``` 
composer update
```

5) Run the post create project script to generate application key
```
composer run-script post-create-project-cmd
```

6) Migrate the tables to the database
```
php artisan migrate
```

7) Serve the project
```
php artisan serve
```

8) then visit http://127.0.0.1:8000/

Done.
