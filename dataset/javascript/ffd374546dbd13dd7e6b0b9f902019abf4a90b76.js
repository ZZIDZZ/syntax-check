function(doc, first, last) { 
							var f = doc.WordPos[first];
							var l;
							if (last==doc.WordPos.length-1) //
								l = doc.DocLength;
							else
								l = doc.WordPos[last+1]; 
							return l-f; 
						}