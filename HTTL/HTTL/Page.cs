using System;
using System.Collections.Generic;
using System.IO;

// Hyper Text Template Language
namespace HTTL
{
    class Page
    {
        public string Template { get; private set; }
        public bool Finished { get; private set; } = false;
        private bool valid = true;
        private List<string> page = new List<string>();
        private List<Tuple<string, Tuple<string, int>>> foundTags = new List<Tuple<string, Tuple<string, int>>>();
        private Dictionary<string, Tuple<int, int>> region = new Dictionary<string, Tuple<int, int>>();
        public bool Saved { get; private set; } = false;

        public Page(string path, string outputPath)
        {
            if (!File.Exists(path))
                return;

            using (StreamReader sr = new StreamReader(path))
            {
                while (!sr.EndOfStream)
                {
                    string line = sr.ReadLine();

                    page.Add(line.Trim());

                }
            }

            string extension = Path.GetExtension(path);
            if (Parser.IsValidExtension(extension))
                ParsePage(page);
            else
            {
                Directory.CreateDirectory(Path.GetDirectoryName(outputPath));
                File.Copy(path, outputPath, true);
                Parser.Errors.Add("File "+path+" is not of any valid template type, copying as-is.");
                Saved = true;

            }
        }

        private void ParsePage(List<string> file)
        {
            string line;
            for (int i = 0; i < file.Count; i++)
            {
                line = file[i];

                if (line.Length == 0)
                    continue;

                if (line[0] == HTTLTokens.StartTag)
                {
                    ParseLine(line, i + 1);

                }
            }

            if (Util.IsEven(foundTags.Count))
            {
                for (int i = 0; i + 1 < foundTags.Count; i += 2)
                {
                    region.Add(foundTags[i].Item1, new Tuple<int, int>(foundTags[i].Item2.Item2, foundTags[i + 1].Item2.Item2));

                }
            }
        }

        private void ParseLine(string line, int lineNumber)
        {
            if (IsEnd(line))
            {
                foundTags.Add(new Tuple<string, Tuple<string, int>>(HTTLTokens.NoIdentifier + lineNumber.ToString(), new Tuple<string, int>(GetTokenType(line), lineNumber)));
                return;

            }

            string identifier = GetEnclosedText(line, lineNumber);
            string lineTokenType = GetTokenType(line);

            foreach (string token in HTTLTokens.Tokens)
            {
                if (GetTokenType(token) == lineTokenType)
                {
                    foundTags.Add(new Tuple<string, Tuple<string, int>>(identifier, new Tuple<string, int>(lineTokenType, lineNumber)));
                    return;

                }
            }
        }

        public void ApplyTemplate(string[] template)
        {
            Dictionary<string, Tuple<int, int>> templateRegions = FindTemplateRegions(template);

            List<string> file = new List<string>();

            bool copy = false;
            int currentCopy = 0;
            Tuple<int, int> copyTo = new Tuple<int, int>(0, 0);
            for (int i = 0; i < template.Length; i++)
            {
                string line = template[i].Trim();

                if (line.Length == 0)
                    continue;

                if (line[0] == HTTLTokens.StartTag)
                {
                    Tuple<int, int> templateText;
                    Tuple<int, int> temp;

                    if (region.TryGetValue(GetEnclosedText(line, i), out temp) && templateRegions.TryGetValue(GetEnclosedText(line, i), out templateText))
                    {
                        currentCopy = temp.Item1 - 1;
                        copyTo = temp;
                        copy = true;
                        continue;

                    }

                    if (temp == null)
                        temp = copyTo;

                    if (line == HTTLTokens.End && copy)
                    {
                        if (currentCopy <= copyTo.Item2)
                        {
                            for (int o = currentCopy; o < copyTo.Item2; o++)
                            {
                                string pageLine = page[o];

                                if (pageLine.Length == 0)
                                    continue;

                                if (pageLine[0] == HTTLTokens.StartTag)
                                    continue;

                                file.Add(pageLine);

                            }
                        }
                    }
                }
                else
                {
                    file.Add(line);

                }
            }
            page = file;

        }

        public void Save(string path)
        {
            if (Finished)
            {
                using (StreamWriter sw = new StreamWriter(path))
                {
                    foreach (string line in page)
                    {
                        sw.WriteLine(line);

                    }
                }
                Saved = true;

            }
        }

        private string GetEnclosedText(string line, int lineNumber)
        {
            int openPosition = line.IndexOf(HTTLTokens.Open);
            int closePosition = line.IndexOf(HTTLTokens.Close);

            if (openPosition == closePosition)
            {
                Parser.Errors.Add("'(' or ')' Expected at line " + lineNumber);
                return "";

            }

            if (openPosition == closePosition + 1)
            {
                Parser.Errors.Add("Identifier between '(' and ')' Expected at line " + lineNumber);
                return "";

            }

            string identifier = line.Substring(openPosition + 1, closePosition - openPosition - 1);


            if (identifier.Length == 0)
            {
                if (line != HTTLTokens.End)
                {
                    Parser.Errors.Add("No identifier found at line " + lineNumber);

                }
                return "";

            }

            if (identifier[0] == '"')
            {
                identifier = identifier.Substring(1, identifier.Length - 2);

            }

            if (line.Substring(0, openPosition - 1) == HTTLTokens.TemplateToken.Substring(0, HTTLTokens.TemplateToken.IndexOf('(') - 1))
            {
                Template = identifier;
                return "";

            }

            return identifier;

        }

        private bool IsEnd(string line)
        {
            if (line == HTTLTokens.End)
                return true;

            return false;

        }

        private string GetTokenType(string token)
        {
            int indexOf = token.IndexOf(HTTLTokens.Open);

            if (indexOf == -1)
                return null;

            string tokenType = token.Substring(0, indexOf);
            return tokenType;

        }

        private Dictionary<string, Tuple<int, int>> FindTemplateRegions(string[] template)
        {
            Dictionary<string, Tuple<int, int>> regions = new Dictionary<string, Tuple<int, int>>();

            string lastName = "";
            int pos1 = 0;
            int pos2 = 0;
            for (int i = 0; i < template.Length; i++)
            {
                string line = template[i].Trim();

                if (GetTokenType(line) == GetTokenType(HTTLTokens.Start))
                {
                    string identifier = GetEnclosedText(line, i);
                    lastName = identifier;
                    pos1 = i;

                }
                if (GetTokenType(line) == GetTokenType(HTTLTokens.End))
                {
                    pos2 = i;
                    regions.Add(lastName, new Tuple<int, int>(pos1, pos2));

                }
            }

            return regions;

        }

        public void Finish()
        {
            if (page.Count == 0)
                valid = false;

            if (valid)
                Finished = true;

        }
    }
}
