const express = require("express");
const app = express();
const bodyParser = require("body-parser");
const mysql = require("mysql");

app.use(bodyParser.json());

const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "family",
});

connection.connect((err) => {
  if (err) throw err;
  console.log("Connected to database");
});

app.get("/family", (req, res) => {
  connection.query("SELECT * FROM families", (error, results) => {
    if (error) throw error;
    res.json(results);
  });
});

app.get("/family/:id", (req, res) => {
  const id = req.params.id;
  connection.query(
    "SELECT * FROM families WHERE id = ?",
    id,
    (error, results) => {
      if (error) throw error;
      if (results.length === 0) {
        res.status(404).json({ message: "Family member not found" });
      } else {
        res.json(results[0]);
      }
    }
  );
});

app.post("/family", (req, res) => {
  const { name, gender, parentId } = req.body;
  const query =
    "INSERT INTO families (name, gender, parent_id) VALUES (?, ?, ?)";
  connection.query(query, [name, gender, parentId], (error) => {
    if (error) throw error;
    res.status(201).json({ message: "Family member created" });
  });
});

app.put("/family/:id", (req, res) => {
  const id = req.params.id;
  const { name, gender, parentId } = req.body;
  const query =
    "UPDATE families SET name = ?, gender = ?, parent_id = ? WHERE id = ?";
  connection.query(query, [name, gender, parentId, id], (error, results) => {
    if (error) throw error;
    if (results.affectedRows === 0) {
      res.status(404).json({ message: "Family member not found" });
    } else {
      res.json({ message: "Family member updated" });
    }
  });
});

app.delete("/family/:id", (req, res) => {
  const id = req.params.id;
  const query = "DELETE FROM families WHERE id = ?";
  connection.query(query, id, (error, results) => {
    if (error) throw error;
    if (results.affectedRows === 0) {
      res.status(404).json({ message: "Family member not found" });
    } else {
      res.json({ message: "Family member deleted" });
    }
  });
});

app.listen(3000, () => {
  console.log("Server is running on port 3000");
});
