import React, {useState, useEffect} from 'react'

const AverageRating = ({averageRating}) => {
  const [lights, setLights] = useState([0,0,0,0,0]);

  useEffect(() => {
    let arr = [0,0,0,0,0];
    for (let index = 0; index < averageRating ; index++) {
      arr[index] = 1;
    };

    setLights(arr)
  }, [averageRating])



  console.log(lights);
  return (
    <div className="ratingContainer">
      {lights.map((star, key) => {
        return (
          star
          ?
            <div key={key} className="ratingContainer__star ratingContainer__star--on"></div>
          :
            <div key={key} className="ratingContainer__star"></div>
        )
      })}
    </div>
  )
}

// .rating__stars {
//   display: flex;
//   justify-content: space-between;
// }

// .rating__star {
//   width: 2rem;
//   height: 2rem;
  
//   background-image: url('img/star-white.svg');
//   background-size: contain;
//   background-repeat: no-repeat;
  
//   cursor: pointer;
// }

// .rating__star--on {
//   background-image: url('img/star-yellow.svg');
// }

export default AverageRating
