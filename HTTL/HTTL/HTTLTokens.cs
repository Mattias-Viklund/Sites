// Hyper Text Template Language
namespace HTTL
{
    class HTTLTokens
    {
        public static string[] Tokens { get; } =
        {
            "#start(*)",
            "#end()"

        };

        public static string TemplateToken { get; } = "#template(*)";

        public static string[] GetTokenTypes()
        {
            string[] tokenTypes = new string[Tokens.Length];
            for (int i = 0; i < Tokens.Length; i++)
            {
                string tokenType = Tokens[i].Substring(0, Tokens[i].IndexOf('(')-1);
                tokenTypes[i] = tokenType;

            }
            return tokenTypes;

        }

        public static string End { get; } = "#end()";
        public static string Start { get; } = "#start(*)";
        public static char StartTag { get; } = '#';
        public static char Wildcard { get; } = '*';
        public static char NoIdentifier { get; } = '^';
        public static char Open { get; } = '(';
        public static char Close { get; } = ')';
    }
}
