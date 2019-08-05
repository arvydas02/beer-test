Development steps
------------
- Analysed given data from CSV 
- Created Entities and migrations
- Imported data from CSV files using Doctrine Data Fixtures module
- Created Services to load data from db and calculate travels data
- Wrote test for Distance calculation and Travel visit algorithm

Notes
------------
- Algorithm is based on travel distance. 
- It calculate all distance between all Geo Codes by given coordinates.
- After we new all distance it search for closet one and make travel.

To Do
------------
- Add relations between tables and update fixtures
