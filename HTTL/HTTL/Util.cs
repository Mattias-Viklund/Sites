using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace HTTL
{
    class Util
    {
        public static bool IsEven(int number)
        {
            if ((number & 1) == 1)
                return false;

            return true;

        }
    }
}
