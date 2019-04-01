SELECT 
               race1.start_time, 
               race1.finish_time, 
               race1.penalty, 
               race1.result_time, 
               competitors.number, 
               competitors.name, 
               competitors.firstname, 
               competitors.club_abrev 
	FROM race1 
               INNER JOIN competitors 
                         ON race1.number = competitors.number 
          WHERE  competitors.ishere = 1 
          AND competitors.isfinish = 1
          AND competitors.categorie_number = $categorie_number
          ORDER BY competitors.sex, 
                    competitors.categorie_number, 
                    race1.result_time ASC



/*
SELECT *
FROM table
WHERE condition
GROUP BY expression
HAVING condition
{ UNION | INTERSECT | EXCEPT }
ORDER BY expression
LIMIT count
OFFSET start