
SELECT no_dokumen, COUNT(*) duplikat FROM status_kasbon GROUP BY no_dokumen HAVING duplikat > 3;
